<script>
    var press=0;
    var x1=0;
    var y1=0;
    var drawcontrol='line';
    function draw(){
        var canvas = document.getElementById('draw');
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = "rgba(0, 0, 200, 0.5)";
        ctx.fillRect (30, 30, 55, 50);
        //document.getElementById('draw').addEventListener('click',function(evt){mouse_click(evt)},false);
        document.getElementById('draw').addEventListener('mousedown',function(evt){ mouse_down(evt)},false);
        document.getElementById('draw').addEventListener('mousemove',function(evt){ mouse_move(evt)},false);
        document.getElementById('draw').addEventListener('mouseup',function(evt){mouse_up(evt)},false);
    }
/*
    function mouse_click(evt){
        var canvas = document.getElementById('draw');
        var ctx = canvas.getContext('2d');
      
        ctx.fillStyle = "rgb(200,0,0)";
        ctx.fillRect (10, 10, 55, 50);
        }
*/
    function  mouse_move(evt){
        var canvas = document.getElementById('draw');
        var ctx = canvas.getContext('2d');
        ctx.clearRect(500, 165, 280, 60);//x,y,w,h
        ctx.font = '48px serif';
        ctx.fillText('x='+evt.clientX+',y='+evt.clientY, 500, 200);//text,x,y
        if(press==1){
            switch(drawcontrol){
                case 'line':
                    drawline(ctx,evt);
                    break;
            }
           // ctx.fillRect (evt.clientX, evt.clientY,5,5);
           
        }

    }
    
    function  mouse_down(evt){
        press = 1;
        x1=evt.clientX;
        y1=evt.clientY;
    }

    function mouse_up(evt){
        press=0;
    }

    function drawline(ctx,evt){
        ctx.beginPath();
        ctx.moveTo(x1, y1);
        ctx.lineTo(evt.clientX,evt.clientY);
        ctx.stroke();
        x1 = evt.clientX;
        y1 = evt.clientY;
    }

</script>
<html>
    <head>

    </head>
    <body onload="draw();">

        
<div >
    <canvas id='draw' width='1600' height='600'> </canvas>
</div>
              
    

  

    </body>
</html>