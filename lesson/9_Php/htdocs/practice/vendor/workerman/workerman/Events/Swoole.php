<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Ares<aresrr#qq.com>
 * @link      http://www.workerman.net/
 * @link      https://github.com/ares333/Workerman
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Workerman\Events;

use Workerman\Worker;
use Swoole\Event;
use Swoole\Timer;
use Swoole\Coroutine;

class Swoole implements EventInterface
{

    protected $_timer = array();

    protected $_timerOnceMap = array();

    protected $mapId = 0;

    protected $_fd = array();

    // milisecond
    public static $signalDispatchInterval = 500;

    protected $_hasSignal = false;

    protected $_readEvents = array();

    protected $_writeEvents = array();

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workerman\Events\EventInterface::add()
     */
    public function add($fd, $flag, $func, $args = array())
    {
        switch ($flag) {
            case self::EV_SIGNAL:
                $res = \pcntl_signal($fd, $func, false);
                if (! $this->_hasSignal && $res) {
                    Timer::tick(static::$signalDispatchInterval,
                        function () {
                            \pcntl_signal_dispatch();
                        });
                    $this->_hasSignal = true;
                }
                return $res;
            case self::EV_TIMER:
            case self::EV_TIMER_ONCE:
                $method = self::EV_TIMER === $flag ? 'tick' : 'after';
                if ($this->mapId > \PHP_INT_MAX) {
                    $this->mapId = 0;
                }
                $mapId = $this->mapId++;
                $t = (int)($fd * 1000);
                if ($t < 1) {
                    $t = 1;
                }
                $timer_id = Timer::$method($t,
                    function ($timer_id = null) use ($func, $args, $mapId) {
                        try {
                            \call_user_func_array($func, (array)$args);
                        } catch (\Exception $e) {
                            Worker::stopAll(250, $e);
                        } catch (\Error $e) {
                            Worker::stopAll(250, $e);
                        }
                        // EV_TIMER_ONCE
                        if (! isset($timer_id)) {
                            // may be deleted in $func
                            if (\array_key_exists($mapId, $this->_timerOnceMap)) {
                                $timer_id = $this->_timerOnceMap[$mapId];
                                unset($this->_timer[$timer_id],
                                    $this->_timerOnceMap[$mapId]);
                            }
                        }
                    });
                if ($flag === self::EV_TIMER_ONCE) {
                    $this->_timerOnceMap[$mapId] = $timer_id;
                    $this->_timer[$timer_id] = $mapId;
                } else {
                    $this->_timer[$timer_id] = null;
                }
                return $timer_id;
            case self::EV_READ:
            case self::EV_WRITE:
                $fd_key = (int) $fd;
                if ($flag === self::EV_READ) {
                    $this->_readEvents[$fd_key] = $func;
                } else {
                    $this->_writeEvents[$fd_key] = $func;
                }
                if (!isset($this->_fd[$fd_key])) {
                    if ($flag === self::EV_READ) {
                        $res = Event::add($fd, [$this, 'callRead'], null, SWOOLE_EVENT_READ);
                        $fd_type = SWOOLE_EVENT_READ;
                    } else {
                        $res = Event::add($fd, null, $func, SWOOLE_EVENT_WRITE);
                        $fd_type = SWOOLE_EVENT_WRITE;
                    }
                    if ($res) {
                        $this->_fd[$fd_key] = $fd_type;
                    }
                } else {
                    $fd_val = $this->_fd[$fd_key];
                    $res = true;
                    if ($flag === self::EV_READ) {
                        if (($fd_val & SWOOLE_EVENT_READ) !== SWOOLE_EVENT_READ) {
                            $res = Event::set($fd, $func, null,
                                SWOOLE_EVENT_READ | SWOOLE_EVENT_WRITE);
                            $this->_fd[$fd_key] |= SWOOLE_EVENT_READ;
                        }
                    } else {
                        if (($fd_val & SWOOLE_EVENT_WRITE) !== SWOOLE_EVENT_WRITE) {
                            $res = Event::set($fd, null, $func,
                                SWOOLE_EVENT_READ | SWOOLE_EVENT_WRITE);
                            $this->_fd[$fd_key] |= SWOOLE_EVENT_WRITE;
                        }
                    }
                }
                return $res;
        }
    }

    /**
     * @param $fd
     * @return void
     */
    protected function callRead($stream)
    {
        $fd = (int) $stream;
        if (isset($this->_readEvents[$fd])) {
            try {
                \call_user_func($this->_readEvents[$fd], $stream);
            } catch (\Exception $e) {
                Worker::stopAll(250, $e);
            } catch (\Error $e) {
                Worker::stopAll(250, $e);
            }
        }
    }

    /**
     * @param $fd
     * @return void
     */
    protected function callWrite($stream)
    {
        $fd = (int) $stream;
        if (isset($this->_writeEvents[$fd])) {
            try {
                \call_user_func($this->_writeEvents[$fd], $stream);
            } catch (\Exception $e) {
                Worker::stopAll(250, $e);
            } catch (\Error $e) {
                Worker::stopAll(250, $e);
            }
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workerman\Events\EventInterface::del()
     */
    public function del($fd, $flag)
    {
        switch ($flag) {
            case self::EV_SIGNAL:
                return \pcntl_signal($fd, SIG_IGN, false);
            case self::EV_TIMER:
            case self::EV_TIMER_ONCE:
                // already remove in EV_TIMER_ONCE callback.
                if (! \array_key_exists($fd, $this->_timer)) {
                    return true;
                }
                $res = Timer::clear($fd);
                if ($res) {
                    $mapId = $this->_timer[$fd];
                    if (isset($mapId)) {
                        unset($this->_timerOnceMap[$mapId]);
                    }
                    unset($this->_timer[$fd]);
                }
                return $res;
            case self::EV_READ:
            case self::EV_WRITE:
                $fd_key = (int) $fd;
                if ($flag === self::EV_READ) {
                    unset($this->_readEvents[$fd_key]);
                } elseif ($flag === self::EV_WRITE) {
                    unset($this->_writeEvents[$fd_key]);
                }
                if (isset($this->_fd[$fd_key])) {
                    $fd_val = $this->_fd[$fd_key];
                    if ($flag === self::EV_READ) {
                        $flag_remove = ~ SWOOLE_EVENT_READ;
                    } else {
                        $flag_remove = ~ SWOOLE_EVENT_WRITE;
                    }
                    $fd_val &= $flag_remove;
                    if (0 === $fd_val) {
                        $res = Event::del($fd);
                        if ($res) {
                            unset($this->_fd[$fd_key]);
                        }
                    } else {
                        $res = Event::set($fd, null, null, $fd_val);
                        if ($res) {
                            $this->_fd[$fd_key] = $fd_val;
                        }
                    }
                } else {
                    $res = true;
                }
                return $res;
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workerman\Events\EventInterface::clearAllTimer()
     */
    public function clearAllTimer()
    {
        foreach (array_keys($this->_timer) as $v) {
            Timer::clear($v);
        }
        $this->_timer = array();
        $this->_timerOnceMap = array();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workerman\Events\EventInterface::loop()
     */
    public function loop()
    {
        Event::wait();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workerman\Events\EventInterface::destroy()
     */
    public function destroy()
    {
        foreach (Coroutine::listCoroutines() as $coroutine) {
            Coroutine::cancel($coroutine);
        }
        // Wait for coroutines to exit
        usleep(100000);
        Event::exit();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workerman\Events\EventInterface::getTimerCount()
     */
    public function getTimerCount()
    {
        return \count($this->_timer);
    }
}
