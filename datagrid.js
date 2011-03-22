     var DATAGRID = (function (ds, edit, url) {
            var ds = (ds != null) ? ds : [];
            var edit = (edit != null) ? edit : {};
            var url = (edit != null) ? url : "";

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
                    type: "GET" });
            }



            function buildtable() {
                var dslen = ds.length;
                var propslen = props.length;
                var table = document.createElement("table");

                var thead = document.createElement("thead");
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
                            var value = this.value;
                            var id = this.id;
                        }
                        text.onblur = function () {
                            var falt = this.className;
                            var value = this.value;
                            var id = this.parentNode.parentNode.id;
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
