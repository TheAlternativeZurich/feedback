# Release checklist
What still needs to be done to deploy & publish the application. Mark points which are already completed.

## setup development environment
- [x] set sensible defaults in `.env.dist`, and put these in `phpunit.xml.dist` too
- [x] adapt the repository name in `.php_cs.dist`
- [x] adapt the deploy path in `servers.yml.dist`
- [x] create the pre-commit hook as specified in `DEVELOPERS.md`
- [x] copy all `*.dist` files, remove the ending to put them in effect
- [x] adapt the repository name & description in `composer.json`
- [x] adapt the repository link in `deploy.php`
- [x] start the CI services which are configured in the `README.md`

## configure symfony template
- [ ] change the brand name in `translations/layout.de.yml`

## release checklist
- [ ] generate favicons with [realfavicongenerator.net](https://realfavicongenerator.net/)