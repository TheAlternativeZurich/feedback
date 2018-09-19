# Release checklist
What still needs to be done to deploy & publish the application. Mark points which are already completed.

## setup development environment
- [ ] set sensible defaults in `.env.dist`, and put these in `phpunit.xml.dist` too
- [ ] adapt the repository name in `.php_cs.dist`
- [ ] adapt the deploy path in `servers.yml.dist`
- [ ] create the pre-commit hook as specified in `DEVELOPERS.md`
- [ ] copy all `*.dist` files, remove the ending to put them in effect
- [ ] adapt the repository name & description in `composer.json`
- [ ] adapt the repository link in `deploy.php`
- [ ] start the CI services which are configured in the `README.md`

## configure symfony template
- [ ] change the brand name in `translations/layout.de.yml`

## release checklist
- [ ] generate favicons with [realfavicongenerator.net](https://realfavicongenerator.net/)