Feature:
    @loginAsAdmin
    Scenario: Try to create Customer with good credentials as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/customers" with body:
        """
        {
            "userId": 2,
            "firstName": "Jan",
            "lastName": "Kowalski",
            "phone": "509508163",
            "birthday": "22-04-19 12:00",
            "gender": "man",
            "address": "ul. Legnicka",
            "subscribedToNewsletter": true
        }
        """
        Then dump the response
        And the response should be in JSON
        And the JSON node id cannot be null
        And the JSON node user cannot be null
