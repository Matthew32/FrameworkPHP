class Task {
    getAndFormat = function (path, element, method = 'get') {
        var xhttp = new XMLHttpRequest();
        var d = new Date();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let formatter = new Formatter();
                var data = JSON.parse(this.responseText);
                if (data.status === 200) {
                    let content = "";
                    let totalHours = 0;
                    for (let i = 0; i < data.content.length; i++) {
                        content += `<tr>
                           <td colspan="2">` + data.content[i].text + `</td>
                           <td>` + formatter.getHoursAndMinutesFromMinutes(data.content[i].duration) + `</td></tr>`

                        totalHours += parseInt(data.content[i].duration);
                    }
                    content += '<td colspan="2"><b>Total ' + d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getUTCFullYear() + '</b></td>';
                    content += '<td ><b>' + formatter.getHoursAndMinutesFromMinutes(totalHours) + '</b></td>';

                    document.getElementById(element).innerHTML = content;
                }else{
                    document.getElementById(element).innerHTML = "Not data found";
                }

            }
        };
        xhttp.open(method, path, true);
        xhttp.send();
    };

    post = function post(path, params, element,elementText, method = 'post') {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                elementText.value = "";

                document.getElementById(element).innerHTML = "saved";
            }
        };
        xhttp.open(method, path, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(params);
    }


}