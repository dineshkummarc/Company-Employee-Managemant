<?php
include '../Department/config.php'; // Include database connection

// DELETE operation for a specific department
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete financial data first
    $sql_finance = "DELETE FROM financial_summary WHERE company_id = (SELECT company_id FROM department WHERE id = ?)";
    $stmt_finance = $conn->prepare($sql_finance);
    $stmt_finance->bind_param("i", $delete_id);
    $stmt_finance->execute();

    // Delete department
    $sql_dept = "DELETE FROM department WHERE id = ?";
    $stmt_dept = $conn->prepare($sql_dept);
    $stmt_dept->bind_param("i", $delete_id);
    $stmt_dept->execute();

    echo "<script>alert('Record deleted successfully'); window.location.href='editDetails.php';</script>";
}

// TRUNCATE operation to delete all records from both tables
if (isset($_GET['truncate'])) {
    $conn->query("SET FOREIGN_KEY_CHECKS=0;"); // Disable foreign key constraint
    $conn->query("TRUNCATE TABLE financial_summary;");
    $conn->query("TRUNCATE TABLE department;");
    $conn->query("SET FOREIGN_KEY_CHECKS=1;"); // Enable foreign key constraint

    echo "<script>alert('All records deleted successfully'); window.location.href='editDetails.php';</script>";
}

// Fetch department & financial details
$sql = "SELECT 
            d.id AS department_id,
            d.deptName,
            d.aboutDept,
            d.deptHead,
            d.aboutHEAD,
            d.company_id,
            d.weekGoal,
            d.monthlyGoal,
            d.deptImage,
            f.id AS financial_id,
            COALESCE(f.revenue, 0) AS revenue,
            COALESCE(f.investment, 0) AS investment,
            COALESCE(f.loss, 0) AS loss,
            f.period
        FROM department d
        LEFT JOIN financial_summary f 
            ON d.company_id = f.company_id";

$result = $conn->query($sql);
?>