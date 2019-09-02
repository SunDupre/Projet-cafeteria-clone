// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add("login", (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add("drag", { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add("dismiss", { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This is will overwrite an existing command --
// Cypress.Commands.overwrite("visit", (originalFn, url, options) => { ... })

Cypress.Commands.add("login", (email, password) => {
    cy.request({
        url: 'process/login.php',
        method: 'POST',
        body: {
            email: email,
            pwd: password,
            valider: 'Connexion'
        },
        form: true
    })
})

// Add a `db_reset` command that flush the database then insert default dataset
Cypress.Commands.add("db_reset", () => {
    cy.exec('docker-compose exec -T webserver php reset.php').its('code')
      .should('eq', 0)
    cy.exec('docker-compose exec -T webserver php fixture.php').its('code')
      .should('eq', 0)
})
