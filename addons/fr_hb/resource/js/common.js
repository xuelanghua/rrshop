function setCookie(c_name, value, expiredays) {
    var exdate = new Date()
    exdate.setDate(exdate.getDate() + expiredays)
    document.cookie=c_name+ "=" + escape(value) + ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=")
        if (c_start!=-1) { 
            c_start = c_start + c_name.length+1 
            c_end = document.cookie.indexOf(";",c_start)
            if (c_end == -1) c_end = document.cookie.length
            return unescape(document.cookie.substring(c_start, c_end))
        } 
    }
    return "";
}
/**
 * 图片预加载
 * @param {array} arr
 * @returns {preloadimages.Anonym$0}
 */
function preloadimages(arr){  
    var newimages=[], loadedimages=0;
    var postaction=function(){}  //此处增加了一个postaction函数
    var arr=(typeof arr!="object")? [arr] : arr;
    function imageloadpost(){
        loadedimages++;
        if (loadedimages == arr.length){
            postaction(newimages); //加载完成用我们调用postaction函数并将newimages数组做为参数传递进去
        }
    }
    for (var i=0; i<arr.length; i++){
        newimages[i]=new Image();
        newimages[i].src=arr[i];
        newimages[i].onload=function(){
            imageloadpost();
        }
        newimages[i].onerror=function(){
            imageloadpost();
        }
    }
    return { //此处返回一个空白对象的done方法
        done:function(f){
            postaction=f || postaction;
        }
    }
}

