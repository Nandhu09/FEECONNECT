const studentData = {
    '202301': { password: '', name: 'John Doe', department: 'CSE', mentor: '', fees: { messFee: 'Paid', hostelFee: 'Paid', busFee: 'Paid', collegeFee: 'Paid', miscFee: 'Pending' } },
    '202302': { password: '', name: 'Jane Smith', department: 'ECE', mentor: '', fees: { messFee: 'Pending', hostelFee: 'Paid', busFee: 'Pending', collegeFee: 'Paid', miscFee: 'Paid' } }
};

function setPassword(event) {
    event.preventDefault();
    const registerNo = document.getElementById('registerNo').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        alert('Passwords do not match!');
        return false;
    }

    if (studentData[registerNo]) {
        studentData}
    }
