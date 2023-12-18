function showTooltip() {
    let tooltip = document.getElementById('tooltip');
    tooltip.style.display = 'block';
}

// Function to hide tooltip when not hovering
function hideTooltip() {
    let tooltip = document.getElementById('tooltip');
    tooltip.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    manHours = manHours.split(";")
    htmlManHoursDetails = "<br>";
    totalManHours = 0;
    if (manHours != "") {
        for (const key in manHours) {
            if (Object.hasOwnProperty.call(manHours, key)) {
                const manHour = manHours[key];
                totalManHours += Number(manHour.split(":")[1]);
                htmlManHoursDetails += (manHour.split(":")[0] + ": " + Number(manHour.split(":")[1]) + " uur<br>");
            }
        }
    }

    let categoryManHours = (totalManHours >= 0 && totalManHours <= 1000) ? 'Laag' : (totalManHours > 1000 && totalManHours <= 5000) ? 'Middel' : 'Hoog';
    let categoryBudget = (budget >= 0 && budget <= 10000) ? 'Laag' : (budget > 10000 && budget <= 50000) ? 'Middel' : 'Hoog';

    document.getElementById("man_hours").innerHTML = "<div class='tooltip-container'>Categorie: " + categoryManHours + "<br><i>(" + totalManHours + " uur)</i>";
    if (manHours != "") {
        document.getElementById("man_hours_help").innerHTML = "<div class='tooltip-container'>Mens Uren" +
        "<span class='question-mark' onmouseover='showTooltip()' onmouseout='hideTooltip()'> &#128712;</span>" +
        "<div class='tooltip-content' id='tooltip' style='display: none;'><p class='tooltip-text'>Mens uren details:<br>" + htmlManHoursDetails + "</p></div></div>";
    }
    document.getElementById("budget").innerHTML = "Categorie: " + categoryBudget + "<br><i>(€" + budget.toLocaleString() + ",-)</i>";
});