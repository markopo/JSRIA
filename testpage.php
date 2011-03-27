<!DOCTYPE HTML>
<html>
<head>
    <title>Untitled Page</title>
    <style type="text/css">


        body {
            margin: 0;
            padding: 0; 
        }

        #content {
            margin: 50px 0 0 50px;
            padding: 0;
        }

        /* Grid-specifika styles */ 

        .datagrid {
           margin: 0;
           padding: 0; 
           background-color: #c3d1fb;
           border-collapse: collapse;
           font: 11px tahoma,arial,helvetica,sans-serif;
           border: 1px solid #A0ABCD;
        }

        .datagrid thead {
            border: 1px solid #A0ABCD;
        }

        .datagrid th {
            margin: 0;
            padding: 5px;
            text-align: left;
        }
        

        .datagrid th:first-letter {
            text-transform: uppercase;
        }

        .datagrid input {
            margin: 0;
            padding: 0;
            border: 1px solid #A0ABCD;
            background: white;
            color: black;
        }


    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        // API - methods
        // ds - datasource = json-array.
        // url - urlen för uppdatering.
        // parameters - lägga till props.



        var DATAGRID = (function (ds, edit, url, cssclass, focuscolor, blurcolor, type) {
            var ds = (ds != null || ds != undefined) ? ds : [];
            var edit = (edit != null || edit != undefined) ? edit : {};
            var url = (url != null || url != undefined) ? url : "";
            var cssclass = (cssclass != null || cssclass != undefined) ? cssclass : "datagrid";
            var focuscolor = (focuscolor != null || focuscolor != undefined) ? focuscolor : "#E4EAFD";
            var blurcolor = (blurcolor != null || blurcolor != undefined) ? blurcolor : "#C7FFB9";
            var type = (type != null || type != undefined) ? type : "GET";
            
            var props = [];


            var obj = ds[0];
            for (var i in obj) {
                if (i != "id") {
                    props.push(i);
                }
            }

           function ajax() {
                return $.ajax({
                    url: url,
                    data: edit,
                    type: type });
            }



            function buildtable() {
                var dslen = ds.length;
                var propslen = props.length;
                var table = document.createElement("table");
                table.className = cssclass; 

                var thead = document.createElement("thead");
                var trthead = document.createElement("tr");
                for(var p=0;p<propslen;p++){
                    var th = document.createElement("th");
                    th.innerHTML = props[p];
                    trthead.appendChild(th);
                }
                thead.appendChild(trthead);
                table.appendChild(thead);

                var tbody = document.createElement("tbody");
                table.appendChild(tbody);

                for (var i = 0; i < dslen; i++) {
                    var tr = document.createElement("tr");
                    tr.id = ds[i].id;

                    for (var j = 0; j < propslen; j++) {
                        var td = document.createElement("td");
                        var text = document.createElement("input");
                        text.type = "text";
                        text.onfocus = function () {
                            var self = this;
                            self.style.backgroundColor = focuscolor; 

                            var value = self.value;
                            var id = self.id;
                            
                            
                        }
                        text.onblur = function () {
                            var self = this;
                            self.style.backgroundColor = blurcolor;
                            setTimeout(function(){
                                self.style.backgroundColor = "#fff";
                            }, 300); 

                            var falt = self.className;
                            var value = self.value;
                            var id = self.parentNode.parentNode.id;
                            edit["falt"] = falt;
                            edit["value"] = value;
                            edit["id"] = id;
                            var r = ajax();
                            
                         
                        }
                        text.className = props[j];
                        text.value = ds[i][props[j]];
                        td.appendChild(text);
                        tr.appendChild(td);
                    }
                    tbody.appendChild(tr);
                }
                return table;
            }


            return {
                table: function () {
                    return buildtable();
                }
            }

        });


        /*
        function loadBackgroundImage(){
            var style = {
              backgroundImage : "url('pattern_122.gif')",
              backgroundPosition : "0 0",
              backgroundRepeat : "repeat"
            };
            $("html").css(style); 

        }
        */ 

        window.onload = function () {
            var ds = [];
            for (var i = 0; i < 100; i++) {
                var obj = { id: i, name: "marko", age: Math.round((Math.random() * i * 0.5) + (15)), height: Math.round(150 + i * 0.5).toString() + "cm" };
                ds.push(obj);
            }

            var grid = new DATAGRID(ds, { hej: "hello", tal: 23  }, "edit.php");

            //DATAGRID(ds, "hej");


            // Attach datagrid to DOM. 
            var content = document.getElementById("content");
            content.appendChild(grid.table()); 


         //    loadBackgroundImage();



        }

    </script>

</head>
<body>
    <div id="content">
        
    </div>

</body>
</html>
