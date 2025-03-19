function addPartner() {
    const partnerSection = document.querySelector('.partner-section');

    // Create a new form-row for additional partner
    const newRow = document.createElement('div');
    newRow.classList.add('form-row');

    // First Name Input
    const firstNameGroup = document.createElement('div');
    firstNameGroup.classList.add('form-group');
    const firstNameLabel = document.createElement('label');
    firstNameLabel.innerText = 'Partner First Name';
    const firstNameInput = document.createElement('input');
    firstNameInput.type = 'text';
    firstNameInput.placeholder = 'First Name';
    firstNameGroup.appendChild(firstNameLabel);
    firstNameGroup.appendChild(firstNameInput);

    // Last Name Input
    const lastNameGroup = document.createElement('div');
    lastNameGroup.classList.add('form-group');
    const lastNameLabel = document.createElement('label');
    lastNameLabel.innerText = 'Partner Last Name';
    const lastNameInput = document.createElement('input');
    lastNameInput.type = 'text';
    lastNameInput.placeholder = 'Last Name';
    lastNameGroup.appendChild(lastNameLabel);
    lastNameGroup.appendChild(lastNameInput);

    // Append inputs to the row
    newRow.appendChild(firstNameGroup);
    newRow.appendChild(lastNameGroup);

    // Add the new row to the partner section
    partnerSection.appendChild(newRow);
}
