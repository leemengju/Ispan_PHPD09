function longTimeWork(workFine = true, errorMessage = "test") {
    return new Promise( (resolve, reject) => {
        setTimeout( () => {
            (workFine) ? resolve(200) : reject(errorMessage);
        }, 1000);
    })
}
// 當多重迴圈出現時，程式會同步執行，並根據執行快慢列印文件。
function usingLongTimeWork() {
    longTimeWork(true, "test")  // try true/false
    .then(function (e) {
        console.log("finished v3:"+e);
    })
    .catch(function (e) {
        console.log(e);
    })
    console.log("go ahead");
}

usingLongTimeWork();
