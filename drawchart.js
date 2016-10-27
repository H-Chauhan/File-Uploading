google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(load_page_data);

function load_page_data() {
    $(".student-wise").click(function () {
        var student_name = $(this).text();
        var result = [];
        $.ajax({
            type: "GET"
            , url: "getstudentwise.php"
            , dataType: 'json'
            , data: {
                'student_name': student_name
            }
            , beforeSend: function () {}
            , success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    data[i][1] = parseInt(data[i][1]);
                }
                result = data;
                drawChart(result, student_name);
            }
        });
    });
    $(".subject-wise").click(function () {
        var subject_name = $(this).text();
        var result = [];
        $.ajax({
            type: "GET"
            , url: "getsubjectwise.php"
            , dataType: 'json'
            , data: {
                'subject_name': subject_name
            }
            , beforeSend: function () {}
            , success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    data[i][1] = parseInt(data[i][1]);
                }
                result = data;
                drawChart(result, subject_name);
            }
        });
    });
}

function drawChart(chart_data, title) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', title);
    data.addColumn('number', 'Percentage');
    data.addRows(chart_data);
    var options = {
        'width': 100
        , 'height': 800
    };
    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(data);
}