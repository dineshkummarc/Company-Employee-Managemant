<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    .goal-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #333;
    }
    .goal-section {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .goal-box {
        display: flex;
        flex-direction: column;
    }
    label h2 {
        font-size: 18px;
        color: #555;
        margin-bottom: 5px;
    }
    .content-box {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    button {
        width: 100%;
        padding: 10px;
        background: rgba(98, 0, 234, 0.8);
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 10px;
    }
    button:hover {
        background: rgba(98, 0, 234, 0.8);
    }
</style>

<section class="goal-container" id="goal">
    <h1>Goals</h1>
    <form id="goal-form" method="POST" action="connectGoals.php">
        <div class="goal-section">
            <div class="goal-box">
                <label for="company-id"><h2>Company ID</h2></label>
                <input type="number" id="company-id" name="company-id" class="content-box" placeholder="Enter company ID..." required>
            </div>
            <div class="goal-box">
                <label for="goal-type"><h2>Goal Type</h2></label>
                <select id="goal-type" name="goal-type" class="content-box" required>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
            <div class="goal-box">
                <label for="goal-description"><h2>Goal Description</h2></label>
                <textarea id="goal-description" name="goal-description" class="content-box" placeholder="Enter your goal description..." required></textarea>
            </div>
            <div class="goal-box">
                <label for="goal-status"><h2>Goal Status</h2></label>
                <select id="goal-status" name="goal-status" class="content-box" required>
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>
        <a href="../Head/Head.php"><button type="submit">Submit</button></a>
    </form>
</section>


</body>
</html>