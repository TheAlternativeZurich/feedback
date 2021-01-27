# Developers
knowledge base for developers.

## Useful commands

##### symfony-cmd
`php bin/console server:run` to start the symfony server  
`doctrine:migrations:diff` to generate the migration class  
`doctrine:migrations:migrate` to execute all migrations  
`doctrine:fixtures:load` to load fixtures

##### cmd
`composer install` to install backend dependencies  
`yarn install && yarn encore dev` to install & build frontend dependencies  
`phpunit` to execute the unit tests  
`vendor/bin/php-cs-fixer fix` to fix code style issues  
`dep deploy` to deploy  

##### develop
login with `info@example.com`, `asdf`  
`yarn encode dev-server` starts the frontend dev server  
test error templates inside TwigBundle/views by accessing `/_error/404` and `/_error/500`

##### deploy
server must fulfil requirements of `composer.json`  
deploy with `famoser/agnes`. For example `vendor/bin/agnes deploy *:*:* master` to deploy master to all environments.
 
##### ssh
`ssh-copy-id -i ~/.ssh/id_rsa.pub username@domain` to add ssh key  
`cat ~/.ssh/id_rsa.pub` to query the active ssh key  
`ssh-keygen -t rsa -b 4096 -C "username@domain" && eval $(ssh-agent -s) && ssh-add ~/.ssh/id_rsa` generate a new key & add it to ssh  
