const app = document.getElementById('root');

// Create a request variable and assign a new XMLHttpRequest object to it.
var request = new XMLHttpRequest();

// Open a new connection, using the GET request on the URL endpoint
request.open('GET', 'https://direct.dnb.com/V5.0/organizations?CountryISOAlpha2Code=US&SubjectName=GORMAN%20MANUFACTURING&match=true&MatchTypeText=Advanced&TerritoryName=CA', true);

request.setRequestHeader("Authorization", "ZBAGQBav3tJnbsmzOzNNWCsRALeyW4zfsU7GihnqV73Ki2EIX4J77Dk8YnJRt30k0IQ0Sc2qnAO");

request.onload = function () {
    // Begin accessing JSON data here
    var data = JSON.parse(this.response);
    app.innerHTML = data.stringify;
}

// Send request
request.send();