# Setup

## Step 1: Installation

Add KtarilaTicketBundle to your requirements:

```bash
composer require ktarila/invoice-bundle
```

### Invoice class

Specify your invoice class in your config.

```yaml
# config/packages/ktarila_invoice.yaml
ktarila_invoice:
    user_class: App\Entity\Invoice
```

Use the Symfony Maker component to generate the invoice class.

```php
% bin/console make:entity Invoice
```

Your Invoice class needs to implement `Ktarila\InvoiceBundle\Model\InvoiceInterface` but the `Ktarila\InvoiceBundle\Model\InvoiceTrait` has already implemented required functions, and has the base entity attributes.

You should end up with a class similar to:

```php
namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Ktarila\InvoiceBundle\Model\InvoiceInterface;
use Ktarila\InvoiceBundle\Model\InvoiceTrait;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice implements InvoiceInterface
{
    use InvoiceTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
```

## Step 2: Enable the bundle

If you are not using [Symfony Flex](https://symfony.com/doc/current/setup/flex.html), you must enable the bundles manually in the kernel:

```php
<?php
// config/bundles.php

return [
    Ktarila\InvoiceBundle\KtarilaBundle::class => ['all' => true],
    // ...
    // Your application bundles
];
```

If you are using an older kernel implementation, you must update the `registerBundles()` method:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        new Ktarila\InvoiceBundle\HackzillaTicketBundle(),
        // ...
        // Your application bundles
    );
}
```

## Step 3: Import the routing

```yml
hackzilla_ticket:
    resource: "@HackzillaTicketBundle/Resources/config/routing.xml"
    prefix: /
```

or

```yml
hackzilla_ticket:
    resource: "@HackzillaTicketBundle/Resources/config/routing/hackzilla_ticket.xml"
    prefix: /ticket
```

## Step 4: Roles

All users can create tickets, even anonymous users.
You can assign "ROLE_TICKET_ADMIN" to any user you want to be able to administer the ticketing system.

## Step 5: Configure your entities

In this version of the ticket-bundle tries to make the entities a lot more configable.
You can use your own entities to power the ticket-bundle.
To do this, then only need to implement the correct interfaces.

-   Hackzilla\Bundle\TicketBundle\Model\TicketInterface
-   Hackzilla\Bundle\TicketBundle\Model\TicketMessageInterface

If you want to have attachments then you can also implement the attachment interface.

-   Hackzilla\Bundle\TicketBundle\Model\MessageAttachmentInterface

### Creating Entities

Entities can be configured with the Symfony Maker component.

First config the name of the entities.
It doesn't matter that they currently do not exist.

```yaml
# config/packages/hackzilla_ticket.yml
hackzilla_ticket:
    user_class: App\Entity\User
    ticket_class: App\Entity\Ticket
    message_class: App\Entity\TicketMessageWithAttachment
```

Next create the basic entities for Ticket and TicketMessage.
This is how you would do it the Maker component.

```bash
% bin/console make:entity

 Class name of the entity to create or update (e.g. BravePopsicle):
 > Ticket

 created: src/Entity/Ticket.php
 created: src/Repository/TicketRepository.php

 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 >

  Success!

 Next: When you're ready, create a migration with php bin/console make:migration
```

Finally, you can use the custom Maker commands to update these entities with the required fields.

```php
% bin/console make:entity:ticket

 user_created_id
 updated: src/Entity/Ticket.php
 last_user_id
 updated: src/Entity/Ticket.php
 last_message
 updated: src/Entity/Ticket.php
 subject
 updated: src/Entity/Ticket.php
 status
 updated: src/Entity/Ticket.php
 priority
 updated: src/Entity/Ticket.php
 createdAt
 updated: src/Entity/Ticket.php
 updated: src/Entity/Ticket.php
 updated: src/Entity/TicketMessage.php

% bin/console make:entity:message

 user_id
 updated: src/Entity/TicketMessage.php
 message
 updated: src/Entity/TicketMessage.php
 status
 updated: src/Entity/TicketMessage.php
 priority
 updated: src/Entity/TicketMessage.php
 createdAt
 updated: src/Entity/TicketMessage.php
 ticket
 no change: src/Entity/TicketMessage.php
 no change: src/Entity/Ticket.php
```

Note: make:entity:message also accepts a `--attachment` argument.

These are now your entities.
You will be able to customise them and even convert the ids to UUIDs if you want.

### Create the database tables

As we are using Doctrine entities, we can get Doctrine to update the database for us.
It's best to check for changes first.

```% bin/console doctrine:schema:update

 The Schema-Tool would execute "1" queries to update the database.
```

If you are happy to proceed, then it would be worth seeing what changes will be made.

```
% bin/console doctrine:schema:update --dump-sql

 The following SQL statements will be executed:

    ALTER TABLE ...
```

If you are happy for doctrine to run the above changes for you, then you can use the force flag.

```
% bin/console doctrine:schema:update --force

 Updating database schema...

     1 query was executed
```

## Step 6: Custom templates (optional)

```yaml
# config/packages/hackzilla_ticket.yaml

hackzilla_ticket:
    templates:
        index: "ticket/index.html.twig"
        new: "ticket/new.html.twig"
        prototype: "ticket/prototype.html.twig"
        show: "ticket/show.html.twig"
        show_attachment: "ticket/show_attachment.html.twig"
```
