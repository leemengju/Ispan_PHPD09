window.onload = function(){
    var canvas, ctx;
    var webSocket = new WebSocket('ws://10.0.100.160:8888');
    var isConnect = false;

    webSocket.onopen = function(event){
        isConnect = true;
    };
    webSocket.onclose = function(event){
        isConnect = false;
    };

    webSocket.onmessage = function(event){
        if (isConnect){
            var drawerObj = JSON.parse(event.data);
            if (drawerObj.isClear){
                clear();
            }else{
                if (drawerObj.isNewLine){
                    newLine(drawerObj.x, drawerObj.y);
                }else{
                    drawLine(drawerObj.x, drawerObj.y);
                }
            }

        }
    };

    canvas = document.getElementById('myDrawer');
    ctx = canvas.getContext('2d');

    function newLine(x, y){
        ctx.beginPath();
        ctx.lineWidth = 4;
        ctx.moveTo(x, y);        
    }

    function drawLine(x,y){
        ctx.lineTo(x, y);
        ctx.stroke();
    }
    function clear(){
        ctx.clearRect(0,0,canvas.width, canvas.height);
    }

}