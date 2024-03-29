// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Metropolis"),
'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
function showPie(input){
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["NPS Score"],
        datasets: [{
            data: input,
            backgroundColor: [
                "rgba(0, 97, 242, 1)",
                "#1C00ff00",
            ],
            hoverBackgroundColor: [
                "rgba(0, 97, 242, 0.9)",
                "#1C00ff00",
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)"
        }]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10
        },
        legend: {
            display: true
        },
        cutoutPercentage: 80
    }
});
}
