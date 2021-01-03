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
