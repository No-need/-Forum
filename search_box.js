var now=0
function getStates(value){
    key = event.keyCode;
    var show_put=document.getElementById("results");
    show_put.style.display="block";
    var slt=document.getElementsByClassName('list_1');
    var cht=document.getElementById("search");
    var len = slt.length;
    if(key==40){    
        if(now>0 && now<len){
            slt[now-1].style.color="black";
            slt[now-1].style.backgroundColor="white";
            slt[now].style.backgroundColor="rgba(0,0,0,0.1)";
            cht.value = slt[now].innerHTML;
            now++;
        }
        else if(now==len){
            slt[now-1].style.color="black";
            slt[now-1].style.backgroundColor="white";
            now=0;
            slt[now].style.backgroundColor="rgba(0,0,0,0.1)";
            cht.value = slt[now].innerHTML;
            now++;
        }
        else{
            slt[now].style.backgroundColor="rgba(0,0,0,0.1)";
            cht.value = slt[now].innerHTML;
            now++;
        }
    }
    else if(key==38){ //上

        if(now==1){
            slt[now-1].style.color="black";
            slt[now-1].style.backgroundColor="white";
            slt[len-1].style.backgroundColor="rgba(0,0,0,0.1)";
            cht.value = slt[len-1].innerHTML;
            now=len;
        }
        else{
            now--;
            slt[now].style.color="black";
            slt[now].style.backgroundColor="white";
            slt[now-1].style.backgroundColor="rgba(0,0,0,0.1)";
            cht.value = slt[now-1].innerHTML;
        }
        
    }
    else if(key==39||key==37){
        
    }
    else{
        $.post("getState.php",{partialState:value},function(data){
            $("#results").html(data);
        });
    }
}
function text_on(clk_me){
    var cht=document.getElementById("search");
    cht.value = clk_me.innerHTML;
}
function hid_search(){
    //alert("sad");
    var show_put=document.getElementById("results");
    if(show_put.style.display=="block"){
        //alert("sad");
        show_put.style.display="none";
    }
}