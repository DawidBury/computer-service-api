Feature:
    @loginAsUser
    Scenario: Try to create ServiceRequest with good credentials as User
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/service-requests" with body:
        """
        {
            "subject": "Problem z komputerem",
            "description": "Wyświetla się bluescreen podczas przeglądania internetu",
            "customerId": 1
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node id cannot be null

    @loginAsUser
    Scenario: Try to create ServiceRequest with bad credentials as User
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/service-requests" with body:
        """
        {
            "subject": "",
            "description": "Wyświetla się bluescreen podczas przeglądania internetu",
            "customerId": 1
        }
        """
        Then the response status code should be 400
        And the response should be in JSON
        And the JSON node message cannot be null

    @loginAsUser
    Scenario: Try to get list with as User
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/service-requests"
        Then the response status code should be 403
        And the response should be in JSON
        And the JSON node message cannot be null

    @loginAsAdmin
    Scenario: Try to get list with as User
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/service-requests"
        Then the response status code should be 200
        And the response should be in JSON