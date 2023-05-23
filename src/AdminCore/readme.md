#### Add routes configuration :
    
    /config/routes.yaml

    admin_core:
        resource:
            path: ../src/AdminCore/Controller/
            namespace: App\AdminCore\Controller
        type: attribute

### Commands
#### Fixtures
To load fixtures
    
    php bin/console app:fixtures:load

To clean database

    php bin/console app:fixtures:clear