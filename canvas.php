<?php 
require_once __DIR__.'/includes/config.php';



$tituloPagina = "Dibujo -";
$contenidoPrincipal=<<<EOS
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 <script type="text/javascript">
      $(document).ready(function () {
         initialize();
      });
      function getPosition(mouseEvent, sigCanvas) {
         var x, y;
         if (mouseEvent.pageX != undefined && mouseEvent.pageY != undefined) {
            x = mouseEvent.pageX;
            y = mouseEvent.pageY;
         } else {
            x = mouseEvent.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            y = mouseEvent.clientY + document.body.scrollTop + document.documentElement.scrollTop;
         }
 
         return { X: x - sigCanvas.offsetLeft, Y: y - sigCanvas.offsetTop };
      }
 
      function initialize() {
         var sigCanvas = document.getElementById("canvasSignature");
         var context = sigCanvas.getContext("2d");
         context.strokeStyle = 'Black';
         var is_touch_device = 'ontouchstart' in document.documentElement;
 
         if (is_touch_device) {
            var drawer = {
               isDrawing: false,
               touchstart: function (coors) {
                  context.beginPath();
                  context.moveTo(coors.x, coors.y);
                  this.isDrawing = true;
               },
               touchmove: function (coors) {
                  if (this.isDrawing) {
                     context.lineTo(coors.x, coors.y);
                     context.stroke();
                  }
               },
               touchend: function (coors) {
                  if (this.isDrawing) {
                     this.touchmove(coors);
                     this.isDrawing = false;
                  }
               }
            };
            function draw(event) {
               var coors = {
                  x: event.targetTouches[0].pageX,
                  y: event.targetTouches[0].pageY
               };
               var obj = sigCanvas;
 
               if (obj.offsetParent) {
                  do {
                     coors.x -= obj.offsetLeft;
                     coors.y -= obj.offsetTop;
                  }
                  while ((obj = obj.offsetParent) != null);
               }
               drawer[event.type](coors);
            }
            sigCanvas.addEventListener('touchstart', draw, false);
            sigCanvas.addEventListener('touchmove', draw, false);
            sigCanvas.addEventListener('touchend', draw, false);
            sigCanvas.addEventListener('touchmove', function (event) {
               event.preventDefault();
            }, false); 
         }
         else {
            $("#canvasSignature").mousedown(function (mouseEvent) {
               var position = getPosition(mouseEvent, sigCanvas);
 
               context.moveTo(position.X, position.Y);
               context.beginPath();
               $(this).mousemove(function (mouseEvent) {
                  drawLine(mouseEvent, sigCanvas, context);
               }).mouseup(function (mouseEvent) {
                  finishDrawing(mouseEvent, sigCanvas, context);
               }).mouseout(function (mouseEvent) {
                  finishDrawing(mouseEvent, sigCanvas, context);
               });
            });
            var clear = function () {
                context.clearRect(0, 0, 500, 500);
              };
              
              $("#clear").on("click", clear);
 
         }
      }
      function drawLine(mouseEvent, sigCanvas, context) {
 
         var position = getPosition(mouseEvent, sigCanvas);
 
         context.lineTo(position.X, position.Y);
         context.stroke();
      }
      function finishDrawing(mouseEvent, sigCanvas, context) {
         drawLine(mouseEvent, sigCanvas, context);
 
         context.closePath();
         $(sigCanvas).unbind("mousemove")
                     .unbind("mouseup")
                     .unbind("mouseout");
      }

      
   </script>
   

 
<div>
   <h1>Canvas test</h1>
 
   <div id="canvasDiv">
      <canvas id="canvasSignature" width="500px" height="500px" style="border:2px solid #000000;"></canvas>
   </div>
   <div id="botton-borrar">
   <button id="clear">Nuevo dibujo</button>
   </div>
</div>
EOS;
require __DIR__.'/includes/plantillas/layout1.php';