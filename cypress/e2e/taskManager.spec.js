describe('Task Manager Tests', () => {
    beforeEach(() => {
        cy.visit('http://localhost:8000'); 
    });

    it('Ajoute une nouvelle tâche', () => {
        cy.get('#taskInput').type('Faire les courses');
        cy.get('#addTaskButton').click();
        cy.get('#taskList').should('contain', 'Faire les courses');
    });

    it('Supprime une tâche', () => {
        cy.get('#taskInput').type('Faire les courses');
        cy.get('#addTaskButton').click();
        cy.get('#taskList li').first().find('.deleteTaskButton').click();
        cy.get('#taskList').should('not.contain', 'Faire les courses');
    });
});
