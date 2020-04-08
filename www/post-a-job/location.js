var select = document.getElementById("job-province");

var provinces = [{
        "name": "SELECT PROVINCE"
    },
    {
        "name": "ALBERTA",
        "abbreviation": "AB"
    },
    {
        "name": "BRITISH COLUMBIA",
        "abbreviation": "BC"
    },
    {
        "name": "MANITOBA",
        "abbreviation": "MB"
    },
    {
        "name": "NEW BRUNSWICK",
        "abbreviation": "NB"
    },
    {
        "name": "NEWFOUNDLAND AND LABRADOR",
        "abbreviation": "NL"
    },
    {
        "name": "NOVA SCOTIA",
        "abbreviation": "NS"
    },
    {
        "name": "NORTHWEST TERRITORIES",
        "abbreviation": "NT"
    },
    {
        "name": "NUNAVUT",
        "abbreviation": "NU"
    },
    {
        "name": "ONTARIO",
        "abbreviation": "ON"
    },
    {
        "name": "PRINCE EDWARD ISLAND",
        "abbreviation": "PE"
    },
    {
        "name": "QUEBEC",
        "abbreviation": "QC"
    },
    {
        "name": "SASKATCHEWAN",
        "abbreviation": "SK"
    },
    {
        "name": "YUKON",
        "abbreviation": "YT"
    }
];


for (var options in provinces){
    select.options[select.options.length] = new Option(provinces[options].name, options)
}

var city = document.getElementById("job-city");

function provCheck() {
    var values = document.getElementById("job-province").value;

    if (values == 12){
        city.options[0] = new Option("SELECT CITY", 0);
        city.options[1] = new Option("SASKATOON", 1);
    }
    if (values != 12) {
        city.options.length = 1;
        alert('The province you selected is not yet available. \nWe are functional in the following provinces only:\nSaskatchewan');
        select.value = 0;
    }
}
