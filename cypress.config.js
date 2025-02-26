const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    specPattern: "cypress/e2e/**/*.spec.js", // S'assure que Cypress voit tous les tests
    baseUrl: "http://localhost:8000", // Définit l'URL de ton application
  },
});
