function get_data(data){
    var url = location.protocol + '//' + location.hostname + '/gwork/get_offers.php';
    $.ajax({url: url, type: 'POST', cache: false, data: data,
    success: function (response) {
        document.getElementById("offers").innerHTML = response;
        addListener();
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
    }});
}

function search(){
    document.getElementById("offers").innerHTML = "";
    data = {};

    data['keyword'] = document.getElementById("keyword").value;
    data['location'] = document.getElementById("location").value;
    data['category'] = document.getElementById("category").value;
    data['job_level'] = document.getElementById("job_level").value;
    data['concract_type'] = document.getElementById("concract_type").value;
    data['working_time'] = document.getElementById("working_time").value;
    data['work_mode'] = document.getElementById("work_mode").value;
    get_data(data);
}