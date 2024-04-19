    function simpan_canvas()
     {
        var image_canvas = document.getElementById("canvas");
        var canvasData = image_canvas.toDataURL("image/png");
        var postData = "canvasData="+canvasData;
         
        var ajax = new XMLHttpRequest();
        ajax.open("POST",'?page=vote&aksi=simpanfoto',true);
        ajax.setRequestHeader('Content-Type', 'canvas/upload');
         
        ajax.onreadystatechange=function()
        {
            if (ajax.readyState == 4)
            {
                //alert(ajax.responseText);
            }
         }
         ajax.send(postData);
     }