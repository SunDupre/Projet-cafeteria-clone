import 'cypress-mailhog'

describe('User authentication', () => {
  beforeEach(() => {
    cy.db_reset();
  })

  it('use registration form and confirmation link', () => {
    const regexp = new RegExp('http://[^ "]*')
    const firstname = 'John'
    const lastname = 'Doe'
    const password = 'secret'
    const email = 'john.doe@realise.ch'

    cy.visit('http://localhost')

    cy.contains('Inscription').click()

    cy.url().should('include', '/inscription.php')

    cy.get('#firstname')
      .type(firstname)
      .should('have.value', firstname)

    cy.get('#lastname')
      .type(lastname)
      .should('have.value', lastname)

    cy.get('#email')
      .type(email)
      .should('have.value', email)

    cy.get('#password')
      .type(password)

    cy.get('#password2')
      .type(password)

    cy.get('#submit').click()

    cy.url().should('include', '/login.php')

    cy.wait(100)

    cy.mhGetMailsByRecipient('john.doe@realise.ch')
      .mhFirst()
      .mhGetBody()
      .then(body => {
        cy.visit(body.match(regexp)[0])

        cy.url().should('include', '/login.php')

        cy.get('#pseudo')
          .type(email)
          .should('have.value', email)

        cy.get('#mdp')
          .type(password)

        cy.get('#login').click()

        cy.url().should('include', '/bookingUser.php')
      })
  })

  it('use the login form then log out', function () {
    cy.visit('http://localhost')

    cy.contains('Connexion').click()

    cy.url().should('include', '/login.php')

    cy.get('#pseudo')
      .type('cuistot@realise.ch')
      .should('have.value', 'cuistot@realise.ch')

    cy.get('#mdp')
      .type('cuistot')

    cy.get('#login').click()

    cy.url().should('include', '/bookingUser.php')

    cy.contains('Déconnexion').click()

    cy.url().should('include', '/index.php')
  })
})

describe('User booking', () => {
  beforeEach(() => {
    cy.db_reset();
  })

  it('book week\' menus', () => {
    cy.login('cuistot@realise.ch', 'cuistot')

    cy.visit('http://localhost/bookingUser.php')
    cy.url().should('include', '/bookingUser.php')

    cy.get('[type="radio"]').first().check()
    cy.get('[type="submit"]').first().click()

    cy.url().should('include', '/bookingUser.php')
    cy.get('[type="radio"]').first().should('be.checked')
  })
})
