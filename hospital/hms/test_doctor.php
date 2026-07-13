<!DOCTYPE html>
<html>
<head>
    <title>Test Doctor Dropdown</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Test Doctor Loading</h2>
    
    <label>Select Specialization:</label>
    <select id="spec" onchange="testGetDoctor(this.value)">
        <option value="">-- Select --</option>
        <option value="ENT">ENT</option>
        <option value="Orthopedics">Orthopedics</option>
        <option value="Pediatrics">Pediatrics</option>
    </select>
    
    <br><br>
    
    <label>Doctors:</label>
    <select id="doctors">
        <option>-- Select Specialization First --</option>
    </select>
    
    <br><br>
    
    <div id="debug" style="border:1px solid #ccc; padding:10px; background:#f5f5f5; font-family:monospace; white-space:pre-wrap;"></div>
    
    <script>
    function testGetDoctor(val) {
        console.log("Selected specialization:", val);
        $('#debug').html('Loading doctors for: ' + val + '...\n');
        
        $.ajax({
            type: "POST",
            url: "get_doctor.php",
            data: 'specilizationid=' + val,
            success: function(data) {
                console.log("Response received:", data);
                $('#debug').append('SUCCESS! Response:\n' + data + '\n');
                $('#doctors').html(data);
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                $('#debug').append('ERROR: ' + error + '\n');
                $('#debug').append('Status: ' + status + '\n');
                $('#debug').append('Response: ' + xhr.responseText + '\n');
            }
        });
    }
    </script>
</body>
</html>
