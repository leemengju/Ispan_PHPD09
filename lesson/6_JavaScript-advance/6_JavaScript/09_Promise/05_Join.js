function happy(data, timeCount) {
    return new Promise( function (resolve, reject) {
        setTimeout(function () {
            resolve(data);
        }, timeCount)
    })
}

function sad(data, timeCount) {
    return new Promise( function (resolve, reject) {
        setTimeout(function () {
            resolve(data);
        }, timeCount)
    })
}

// 總共需要等五秒
async function living() {
    var promise1 = happy(200, 2000);
    var promise2 = sad(100, 3000);
    var result1 = await promise1;
    var result2 = await promise2;

    var total = result1 + result2;
    console.log("total:", total);
}

living();

