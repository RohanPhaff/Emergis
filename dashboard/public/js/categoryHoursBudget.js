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
    htmlManHoursDetails = "";
    totalManHours = 0;
    if (manHours != "") {
        for (const key in manHours) {
            if (Object.hasOwnProperty.call(manHours, key)) {
                const manHour = manHours[key];
                totalManHours += Number(manHour.split(":")[1]);
                htmlManHoursDetails += (manHour.split(":")[0] + ": " + Number(manHour.split(":")[1]) + " uur <i>(" + manHour.split(":")[2] + ")</i><br>");
            }
        }
    }

    if (manHours != "") {
        document.getElementById("man_hours").innerHTML = "<div class='tooltip-container'>" + htmlManHoursDetails;
    } else {
        document.getElementById("man_hours").innerHTML = "<div class='tooltip-container'><i>Niet ingevuld</i>";
    }

    if (budget != 0) {
        document.getElementById("budget").innerHTML = "€" + Math.round(budget / 1000) + "K " + "<i>(" + categoryBudget + ")</i>";
    } else {
        document.getElementById("budget").innerHTML =  "<i>Niet ingevuld</i>";
    }

    if (spendCosts != 0) {
        document.getElementById("spend_costs").innerHTML = "€" + Math.round(spendCosts / 1000) + "K";
    } else {
        document.getElementById("spend_costs").innerHTML =  "<i>Niet ingevuld</i>";
    }

    if (startDate != null && endDate != null) {
        document.getElementById("duration").innerHTML = startDate + " tot " + endDate;
    } else if (startDate != null || endDate != null) {
        document.getElementById("duration").innerHTML = ((startDate != null) ? startDate : "<i>Niet ingevuld</i>") + " tot " + ((endDate != null) ? endDate : "<i>Niet ingevuld</i>");
    } else {
        document.getElementById("duration").innerHTML =  "<i>Niet ingevuld</i>";
    }
});