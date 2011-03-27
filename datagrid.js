

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