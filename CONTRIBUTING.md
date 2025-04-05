# Contributing

Contributions are welcome and will be fully credited.

## Pull Requests

- **[PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/)** - The easiest way to apply the conventions is to install [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer).
- **Add tests** - Your patch won't be accepted if it doesn't have tests.
- **Document any change in behavior** - Make sure the `README.md` and other relevant documentation are kept up-to-date.
- **Consider our release cycle** - We try to follow [SemVer v2.0.0](https://semver.org/). Randomly breaking public APIs is not an option.
- **Create feature branches** - Don't ask us to pull from your master branch.
- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.
- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](https://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.
- **Make classes final when not designed for extension** - If a class is not intended to be subclassed, mark it as `final` to enforce immutability and prevent unintended inheritance.

## Development Environment

We recommend using Docker to set up your development environment. Here's a quick way to get started:

```bash
# Clone the repository
git clone https://github.com/derrickobedgiu1/hostinger-php-sdk.git
cd hostinger-php-sdk

# Install dependencies
composer install

# Run cs, phpstan, rector & tests
composer tests
```

## Fix Test Errors

```bash
# Run all code unit tests
composer test:unit

# Run static analysis
composer analyze

# Fix code style issues
composer cs:fix

# Run rector to apply automatic code fixes
composer rector:fix
```

## Adding Support for New API Endpoints

1. **Create Data Transfer Objects**: Add a new DTO class in the appropriate directory under `src/Data/`.
2. **Create or Update Enums**: If the endpoint uses enumerated values, add or update the enum classes in `src/Enums/`.
3. **Create Resource Class**: Add a new resource class in the appropriate directory under `src/Resources/`.
4. **Update Facade**: If necessary, update the relevant facade class in `src/Facades/`.
5. **Add Tests**: Create unit tests for your new classes.
6. **Update Documentation**: Update the README.md with examples of how to use the new functionality.

## Guidelines for Creating DTOs

When creating a new DTO (Data Transfer Object):

1. Extend the base `Data` class.
2. Define public properties with appropriate type hints.
3. Implement a constructor that correctly maps API response data to the DTO properties.
4. Use proper PHP 8.1+ features like constructor property promotion when appropriate.
5. Use enums for fields that have a fixed set of possible values.
6. Add proper PHPDoc comments to document the properties and methods.

Example:

```php
<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Example;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\ExampleStatus;

final class Example extends Data
{
    public int $id;
    
    public string $name;
    
    public ExampleStatus $status;
    
    public DateTimeImmutable $created_at;
    
    /**
     * @param array{
     *     id: int,
     *     name: string,
     *     status: string,
     *     created_at: string
     * } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->status = ExampleStatus::from($data['status']);
        $this->created_at = new DateTimeImmutable($data['created_at']);
    }
}
```

## Guidelines for Creating Resource Classes

When creating a new resource class:

1. Extend the `AbstractResource` class.
2. Use descriptive method names that align with the API operations.
3. Add proper PHPDoc comments to document the parameters and return types.
4. Use the `transformResponse` method to convert API responses to DTOs.

Example:

```php
<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Example;

use DerrickOb\HostingerApi\Data\Example\Example as ExampleData;
use DerrickOb\HostingerApi\Resources\Resource;

final class Example extends Resource
{
    /**
     * List all examples
     *
     * @param array $query Optional query parameters
     * @return ExampleData[] The list response
     */
    public function list(array $query = []): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/example/%s/examples', $version), $query);

        return $this->transformResponse(ExampleData::class, $response);
    }

    /**
     * Get a specific example
     *
     * @param int $id Example ID
     * @return ExampleData
     */
    public function get(int $id): ExampleData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/example/%s/examples/%d', $version, $id));

        return $this->transformResponse(ExampleData::class, $response);
    }
}
```

## Reporting Issues

When reporting issues, please include:
- A clear description of the issue
- Steps to reproduce
- Expected behavior
- Actual behavior
- PHP version
- SDK version
- Sample code if applicable

## Security Issues

If you discover a security vulnerability, please email [derrickobedgiu@gmail.com](mailto:derrickobedgiu@gmail.com) instead of using the issue tracker. All security vulnerabilities will be promptly addressed.