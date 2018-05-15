# Bdd API IO Context

Helper context classes for easy ATDD in a Api Rest with Behat

# Enable MinkExtension in your behat.yml

```yaml
default:
  extensions:
    Behat\MinkExtension:
      sessions:
        my_session:
          symfony2: ~
```

# Add Request and Response contexts to your paths
```yaml
  suites:
    yoursuitte:
      paths: [ tests/api/features/product ]
      contexts:
        - Pccomponentes\BddApiIOContext\Infrastructure\Behat\ApiContext\ApiRequestContext
        - Pccomponentes\BddApiIOContext\Infrastructure\Behat\ApiContext\ApiResponseContext
```

# Now, you can use the contexts in your features

Examples:
```gherkin
#POST
Scenario: Create a product
    When  I send a POST request to "/products" with body:
    """
    {
      "product_id": "73118479-28a6-401e-9dad-6c88eac17484",
      "name": "fake product"
    }
    """
    Then the response should be empty
    And the response status code should be 201
```
```gherkin    
#GET
Scenario: Find an existing family
    When I send a GET request to "/products/73118479-28a6-401e-9dad-6c88eac17484"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "15dcd91e-4f29-4975-ac7c-560915af5b62",
      "name": "Family for search",
      "packaging_type": "VOLUMETRIC",
      "serial_number_required": true
    }
    """
```

Don`t forget your given clauses for prepare your scenarios!!!

# Good practices

Is a good practice create another context that reset your environment and execute before any test

```php
    /** @BeforeScenario */
    public function clearEnvironment()
    {
        //... clear your envirnomnet
    }
```