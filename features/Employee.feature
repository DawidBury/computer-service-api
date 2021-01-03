Feature:
    @loginAsAdmin
    Scenario: Try to create Employee with good credentials as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/employees" with body:
        """
        {
            "firstName": "Jan",
            "lastName": "Kowalski",
            "businessNumber": "509508163",
            "email": "test@test.pl"
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node id should not be null

    @loginAsUser
    Scenario: Try to create Employee with good credentials as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/employees" with body:
        """
        {
            "firstName": "Jan",
            "lastName": "Kowalski",
            "businessNumber": "509508163",
            "email": "test@test.pl"
        }
        """
        Then the response status code should be 403
        And the response should be in JSON

    @loginAsAdmin
    Scenario: Try to create Employee with bad credentials as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/employees" with body:
        """
        {
            "firstName": 1,
            "lastName": 2,
            "businessNumber": "509508163",
            "email": "test.pl"
        }
        """
        Then the response status code should be 400
        And the response should be in JSON
        And the JSON node message cannot be null
