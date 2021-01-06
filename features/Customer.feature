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
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node id cannot be null
        And the JSON node user cannot be null

    @loginAsUser
    Scenario: Try to create Customer with good credentials as User
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/customers" with body:
        """
        {
            "userId": 4,
            "firstName": "Jan",
            "lastName": "Kowalski",
            "phone": null,
            "birthday": null,
            "gender": "man",
            "address": "ul. Legnicka",
            "subscribedToNewsletter": false
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node id cannot be null
        And the JSON node user cannot be null

    Scenario: Try to create Customer with good credentials as not logged in user
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/customers" with body:
        """
        {
            "userId": 4,
            "firstName": "Jan",
            "lastName": "Kowalski",
            "phone": null,
            "birthday": null,
            "gender": "man",
            "address": "ul. Legnicka",
            "subscribedToNewsletter": false
        }
        """
        Then the response status code should be 401
        And the response should be in JSON