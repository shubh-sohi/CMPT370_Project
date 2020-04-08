
// href=location.reload();
function loadJSON(callback) {

    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', '../jobsjson/search.json', true);
    xobj.onreadystatechange = function() {
        if (xobj.readyState == 4 && xobj.status == "200") {

            // .open will NOT return a value but simply returns undefined in async mode so use a callback
            callback(xobj.responseText);

        }
    }
    xobj.send(null);

}

// Call to function with anonymous callback
loadJSON(function(response) {
    var myObj = JSON.parse(response);
    console.log(myObj);
    // Do Something with the response e.g.
    //jsonresponse = JSON.parse(response);

    // Assuming json data is wrapped in square brackets as Drew suggests
    //console.log(jsonresponse[0].name);



    var container = document.getElementById("mini_disc");
    var container_right = document.getElementById("detail_disc");
    var formpost = document.getElementById("req_button");
    var btn = document.createElement("BUTTON");
    var btn_value = document.createElement("INPUT");
    btn_value.setAttribute("type", "hidden");
    btn_value.name = "btn_val";

    function display_job(ok){

        container_right.innerHTML = "";
        // console.log(ok);
        var detail_job_display = document.createElement("div");
        btn.innerHTML = "Request This Job!";
        btn.id = myObj[ok].job_id;
        btn.classList.add("request-button");
        btn.name = "request_btn";
        btn_value.value = myObj[ok].job_id;
        formpost.appendChild(btn_value);
        formpost.appendChild(btn);
        // container_right.appendChild(btn);
        detail_job_display.classList.add("job-detail");
        detail_job_display.innerHTML = myObj[ok].title + "<br><br>" + "Category: " + myObj[ok].category +
            "<br>" + "Pay: " + myObj[ok].amount+"$"+"<br><br>" + myObj[ok].job_description + "<br><br>" + "Address:" + "<br>" +
            myObj[ok].job_address+ "<br><br>";
        detail_job_display.appendChild(formpost);
        // detail_job_display.removeChild(formpost);
        container_right.appendChild(detail_job_display);

    }
    for(var options in myObj){
//     console.log(new_ar[options], options);
        var mini_job = document.createElement("button");
        mini_job.classList.add("mini-job-container");
        mini_job.innerHTML = myObj[options].title + "<br>" + "Pay: "+myObj[options].amount+"$" + "<br>" + "City: "+ myObj[options].job_address;
        mini_job.id = options;
        mini_job.addEventListener('click', function () {
            display_job(this.id);
        });
        // console.log(document.getElementById("mini_disc"), mini_job);
        container.appendChild(mini_job);

    }


});

