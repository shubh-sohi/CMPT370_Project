var select = document.getElementById("job_province");

var provinces = [{
        "name": "Select Province"
    },
    {
        "name": "Alberta",
        "abbreviation": "AB"
    },
    {
        "name": "British Columbia",
        "abbreviation": "BC"
    },
    {
        "name": "Manitoba",
        "abbreviation": "MB"
    },
    {
        "name": "New Brunswick",
        "abbreviation": "NB"
    },
    {
        "name": "Newfoundland and Labrador",
        "abbreviation": "NL"
    },
    {
        "name": "Nova Scotia",
        "abbreviation": "NS"
    },
    {
        "name": "Northwest Territories",
        "abbreviation": "NT"
    },
    {
        "name": "Nunavut",
        "abbreviation": "NU"
    },
    {
        "name": "Ontario",
        "abbreviation": "ON"
    },
    {
        "name": "Prince Edward Island",
        "abbreviation": "PE"
    },
    {
        "name": "Quebec",
        "abbreviation": "QC"
    },
    {
        "name": "Saskatchewan",
        "abbreviation": "SK"
    },
    {
        "name": "Yukon",
        "abbreviation": "YT"
    }
];


for (var options in provinces){
    select.options[select.options.length] = new Option(provinces[options].name, options)
}

var city = document.getElementById("job_city");

function provCheck() {
    var values = document.getElementById("job_province").value;

    if (values == 12){
        city.options[1] = new Option("Saskatoon", 1);
    }
    if (values != 12) {
        city.options.length = 1;
        alert('The province you selected is not yet available. \nWe are functional in the following provinces only:\nSaskatchewan');
        select.value = 0;
    }
}
