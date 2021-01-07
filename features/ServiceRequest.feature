Feature:
    @loginAsUser
    Scenario: Try to create Customer with good credentials as Admin
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