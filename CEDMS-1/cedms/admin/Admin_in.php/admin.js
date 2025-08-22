document.addEventListener('DOMContentLoaded', () => {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const contentArea = document.getElementById('contentArea');

    // Sample content pages with iframe loading for PHP pages
    const pageContent = {
        employee: `
            <iframe src="viewEmp.php" style="width:100%; height:100%; border:none;"></iframe>
        `,
        departments: `
            <iframe src="editDetails.php" style="width:100%; height:100%; border:none;"></iframe>
        `,
        subscription: `
            <iframe src="subscription.html" style="width:100%; height:100%; border:none;"></iframe>
        `,
        goals: `
            <iframe src="goals.php" style="width:100%; height:100%; border:none;"></iframe>
        `,
        revenue: `
          <iframe src="financialSum.php" style="width:100%; height:100%; border:none;"></iframe>  
        `
    };

    // Add click event to sidebar items
    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            // Remove active class from all items
            sidebarItems.forEach(i => i.classList.remove('active'));
            
            // Add active class to clicked item
            item.classList.add('active');
            
            // Load content based on data-page attribute
            const page = item.getAttribute('data-page');
            contentArea.innerHTML = pageContent[page] || 'Page not found';
        });
    });

    // Default to first page (Employee)
    sidebarItems[0].click();
});