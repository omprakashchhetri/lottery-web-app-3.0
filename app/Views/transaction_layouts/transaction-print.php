<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mBOB Transfer System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat', sans-serif;

        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        background: white;
        width: 100%;
        max-width: 390px;
        min-width: 360px;
        border-radius: 20px;
        /* box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); */
        overflow: hidden;
        position: relative;
    }

    .header {
        text-align: center;
        background: white;
        padding-top: 40px;
    }

    .logo {
        max-width: 200px;
        margin: auto;
    }

    .logo img {
        width: 100%;
    }

    .check-icon {
        max-width: 70px;
        margin-inline: auto;
        padding-top: 20px;
        padding-bottom: 25px;
        display: none;
    }

    /* Form Styles */
    .form-container {
        padding: 20px;
    }

    .form-title {
        color: #4ECDC4;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #333;
        font-weight: bold;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #E5E7EB;
        border-radius: 10px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #4ECDC4;
    }

    .radio-group {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .radio-option input[type="radio"] {
        width: auto;
        margin: 0;
    }

    .radio-option label {
        margin: 0;
        font-weight: normal;
        cursor: pointer;
    }

    .submit-btn {
        background: linear-gradient(135deg, #4ECDC4, #44A08D);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: bold;
        width: 100%;
        cursor: pointer;
        transition: transform 0.2s;
        margin-top: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
    }

    /* Receipt Styles */
    .receipt-container {
        display: none;
    }

    .success-title {
        color: #1BB152;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .details-section {
        background: #46C1F6;
        padding: 30px 20px;
        margin: 0 15px;
        border-radius: 50px;
        color: white;
        position: relative;
        overflow: hidden;

        /* Background image */
        background-image: url(<?= base_url('assets/images/background-mbob-14161112sasas.png') ?>);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 75%;
        /* or 'cover' if you want it to fill */
        /* Makes the whole section slightly lighter */
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .detail-row:last-child {
        margin-bottom: 0;
    }

    .detail-label {
        font-size: 14px;
        opacity: 0.9;
        width: 55%;
        display: flex;
        justify-content: space-between;
        padding-right: 10px;
    }

    .detail-value {
        font-size: 14px;
        font-weight: 700;
        width: 45%;
    }

    .ok-button {
        background: #46C1F6;
        color: white;
        border: none;
        padding: 10px 40px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: bold;
        margin: 25px auto;
        display: block;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .ok-button:hover {
        background: #0E7490;
    }

    .bottom-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 30px 30px;
    }

    .action-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: none;
        border: none;
        color: #fff;
        background: #46C1F6;
        cursor: pointer;
        font-size: 14px;
    }

    .share-btn {
        width: 35px;
        aspect-ratio: 1;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 5px;
    }

    .share-btn img {
        width: 60%;
        filter: brightness(0) invert();
    }

    .save-button {
        width: 35px;
        aspect-ratio: 1;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 5px;
    }

    .save-button img {
        width: 60%;
        filter: brightness(0) invert();
    }

    .generate-btn {
        background: #22C55E;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        margin: 0 10px;
        transition: background-color 0.3s;
    }

    .generate-btn:hover {
        background: #16A34A;
    }

    .back-btn {
        background: #6B7280;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        margin: 0 10px;
        transition: background-color 0.3s;
    }

    .back-btn:hover {
        background: #4B5563;
    }

    .notification-card {
        background: white;
        border-radius: 25px;
        padding: 16px;
        width: 100%;
        min-width: 361px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        max-width: 380px;
        max-width: 340px;
        margin: 0 auto;
        position: fixed;
        top: 20px;
        left: 50%;
        translate: -50%;
        display: none;
        z-index: 10;
    }

    .glassy-blue {
        width: 100%;
        padding: 1rem;
        border-radius: 8px;
        /* color: white; */

        background: linear-gradient(to right,
                rgba(213, 204, 204, 0.2) 0%,
                rgba(0, 123, 255, 0.1) 50%,
                rgba(213, 204, 204, 0.2) 100%);

        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);

        /*border: 1px solid rgba(255, 255, 255, 0.2);*/
        /* Optional: frosted border */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        /* Optional: soft shadow */

    }


    .notification-header {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .notification-header-2 {
        margin: 0;
    }

    .app-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
        flex-shrink: 0;
    }

    .app-icon img,
    .app-icon-2 img {
        width: 100%;
    }

    .app-icon-2 {
        width: 30px;
        height: 30px;
        padding: 2px;
        border-radius: 8px;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        /* margin-right: 8px; */
        flex-shrink: 0;
    }

    .app-name {
        font-size: 14px;
        color: #333;
        font-weight: 500;
        margin-right: 4px;
    }

    .time-badge {
        font-size: 12px;
        color: #666;
        /* margin-right: auto; */
    }

    .notification-icon {
        width: 25px;
        height: 25px;

    }

    .notification-icon img {
        width: 100%;
    }

    .expand-button {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 25px;
        height: 25px;
        border-radius: 100px;
        padding: 5px;
        border: none;
        background: #e7e7e7;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .expand-button img {
        width: 100%;
    }

    .notification-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        margin-left: 25px;
    }

    .notification-content {
        font-size: 14px;
        color: #333;
        line-height: 1.4;
        margin-left: 25px;
    }

    .notification-title-2 {
        font-weight: 600;
        margin-bottom: 0;
        font-size: 12px;
        margin-left: 0;
    }

    .notification-content-2 {
        margin-left: 0;
    }

    .notification-content-3 {
        margin-left: 15px;
        width: 100%;
    }

    .truncate {
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .content-line {
        margin-bottom: 2px;
        font-size: 12px;
        line-height: 1.5;
        font-weight: 500;
    }

    .content-line:last-child {
        margin-bottom: 0;
    }

    .colen-cls {
        font-weight: 600;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="<?=base_url('assets/images/5456411564.jpg')?>" alt="">
            </div>
        </div>

        <div data-notify="1" class="notification-card">
            <div class="notification-header">
                <div class="app-icon"><img src="<?=base_url('assets/images/mbob-teytds.png')?>" alt=""></div>
                <span class="app-name">mBoB</span>
                <span class="time-badge">• now</span>
                <div class="notification-icon">
                    <img src="<?=base_url('assets/images/notification-alert-icon-1633777-512.png')?>" alt="">
                </div>
            </div>

            <button class="expand-button"><img src="<?=base_url('assets/images/arrow-upsas.png')?>" alt=""></button>

            <div class="notification-title">BOB</div>

            <div class="notification-content">
                <div class="content-line">Fund Transfer to BoB Successful</div>
                <div class="content-line">Amount : <span class="trans-amount">Nu. 1.00</span></div>
                <div class="content-line">Jrnl. No : <span class="trans-jrnl">2404440</span></div>
                <div class="content-line">From Account : <span class="trans-from-account">20XXXXX27</span></div>
                <div class="content-line">To Account : <span class="trans-to-account">20XXXXX26</span></div>
                <div class="content-line">Purpose : <span class="trans-purpose">K</span></div>
                <div class="content-line">Date : <span class="trans-date">20 Jul 2025</span></div>
                <div class="content-line">Time : <span class="trans-time">10:13:40 PM</span></div>
            </div>
        </div>
        <div data-notify="2" class="notification-card">
            <div class="notification-title-2">BOB</div>
            <div class="notification-content-2">
                <div class="content-line truncate">Fund Transfer to BoB Successful Amount : <span
                        class="trans-amount">Nu.
                        1.00</span> Jrnl. No : <span class="trans-jrnl">2404440</span></div>
            </div>
        </div>
        <div data-notify="3" class="notification-card glassy-blue">
            <div style="display: flex; align-items: center;">
                <div class="notification-header-2">
                    <div class="app-icon-2"><img src="<?=base_url('assets/images/mbob-teytds.png')?>" alt=""></div>
                </div>

                <div class="notification-content-3">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="content-line" style="font-weight: 600;">Fund Transfer to BoB Successful</div>
                        <div class="notification-icon">
                            <span class="time-badge">now</span>
                        </div>
                    </div>
                    <div class="content-line">Amount : <span class="trans-amount">Nu. 1.00</span></div>
                    <div class="content-line">Jrnl. No : <span class="trans-jrnl">2404440</span></div>
                </div>

            </div>

        </div>
        <!-- Form Section -->
        <div id="formSection" class="form-container">
            <div class="form-title">Fund Transfer Details</div>

            <form id="transferForm">
                <div class="form-group">
                    <label>Transfer Type:</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="otherBank" name="transferType" value="other" checked>
                            <label for="otherBank">Other Bank</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="sameBank" name="transferType" value="same">
                            <label for="sameBank">Same Bank (BoB)</label>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="notificationGroup" style="display: none;">
                    <label>Notification Type:</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="notif1" name="notificationType" value="1" checked>
                            <label for="notif1">Notification 1</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="notif2" name="notificationType" value="2">
                            <label for="notif2">Notification 2</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="notif3" name="notificationType" value="3">
                            <label for="notif3">Notification 3</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" placeholder="Enter amount (e.g., Nu. 1.00)" required>
                </div>

                <div class="form-group">
                    <label for="jrnlNo">Jrnl. No:</label>
                    <input type="number" id="jrnlNo" name="jrnlNo" placeholder="Enter journal number" required>
                </div>

                <div class="form-group">
                    <label for="rrno">RRNO:</label>
                    <input type="number" id="rrno" name="rrno" placeholder="Enter RRNO" required>
                </div>

                <div class="form-group">
                    <label for="fromAccount" id="fromAccountLabel">From Account No:</label>
                    <input type="number" id="fromAccount" name="fromAccount" placeholder="Enter from account number"
                        required>
                </div>

                <div class="form-group" id="toAccountGroup">
                    <label for="toAccount" id="toAccountLabel">To Account No:</label>
                    <input type="number" id="toAccount" name="toAccount" placeholder="Enter to account number" required>
                </div>

                <div class="form-group">
                    <label for="beneficiaryName" id="beneficiaryLabel">Beneficiary Name:</label>
                    <input type="text" id="beneficiaryName" name="beneficiaryName" placeholder="Enter beneficiary name"
                        required>
                </div>

                <button type="submit" class="submit-btn">Generate Receipt</button>
            </form>
        </div>

        <!-- Receipt Section -->
        <div id="receiptSection" class="receipt-container">
            <div style="text-align: center;">
                <img class="check-icon completed" src="<?=base_url('assets/images/check-done-transaction.png')?>"
                    alt="">
                <img class="check-icon incompleted" src="<?=base_url('assets/images/check-incomp.png')?>" alt="">
            </div>

            <div class="success-title" id="successTitle">
                Fund Transfer to Other Bank<br>
                Successful
            </div>

            <div class="details-section">
                <div class="detail-row">
                    <span class="detail-label"><span>Amount</span> <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptAmount">: Nu. 1.00</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><span>Jrnl. No</span> <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptJrnl">: 2410754</span>
                </div>
                <div class="detail-row" id="rrNoField">
                    <span class="detail-label"><span>RRNO</span> <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptRrno">: 520122183419</span>
                </div>
                <div class="detail-row" id="receiptFromAccountRow">
                    <span class="detail-label" id="receiptFromAccountLabel"><span>From Account No</span>
                        <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptFromAccount">: 20XXXXX27</span>
                </div>
                <div class="detail-row" id="receiptToAccountRow">
                    <span class="detail-label" id="receiptToAccountLabel"><span>To Account No</span>
                        <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptToAccount">: 65XXXXX71</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label" id="receiptBeneficiaryLabel"><span>Beneficiary Name</span>
                        <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptBeneficiary">: CHENCHO WANGDI</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><span>Date</span> <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptDate">: 20 Jul 2025</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><span>Time</span> <span class="colen-cls">:</span></span>
                    <span class="detail-value" id="receiptTime">: 10:18:01 PM</span>
                </div>
            </div>

            <button class="ok-button" onclick="goBackToForm()">OK</button>

            <div class="bottom-actions">
                <button style="background: transparent; border: none;" onclick="">
                    <div class="save-button action-button">
                        <img src="<?=base_url('assets/images/arrow-downsas.png')?>" alt="">
                    </div>
                    <span>Save</span>
                </button>
                <button style="background: transparent; border: none;" onclick="">
                    <div class="share-btn action-button">
                        <img src="<?=base_url('assets/images/share-icon.svg')?>" alt="">
                    </div>
                    <span>Share</span>
                </button>
            </div>
        </div>
    </div>

    <script>
    // Function to mask account number - show first 2 and last 2 digits
    function maskAccountNumber(accountNo) {
        if (accountNo.length <= 4) {
            return accountNo; // If too short, return as is
        }
        const first2 = accountNo.substring(0, 2);
        const last2 = accountNo.substring(accountNo.length - 2);
        const middleLength = accountNo.length - 4;
        const masked = first2 + 'X'.repeat(middleLength) + last2;
        return masked;
    }

    // Function to format current date and time
    function getCurrentDateTime() {
        const now = new Date();
        const day = now.getDate().toString().padStart(2, '0');
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        const month = months[now.getMonth()];
        const year = now.getFullYear();

        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;

        const date = `${day} ${month} ${year}`;
        const time = `${hours}:${minutes}:${seconds} ${ampm}`;

        return {
            date,
            time
        };
    }

    // Handle transfer type change
    document.querySelectorAll('input[name="transferType"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const isSameBank = this.value === 'same';
            const notificationGroup = document.getElementById('notificationGroup');

            if (isSameBank) {
                // Show notification options
                notificationGroup.style.display = 'block';

                // Update labels
                document.getElementById('fromAccountLabel').textContent = 'From Account:';
                document.getElementById('toAccountLabel').textContent = 'To Account:';
                document.getElementById('beneficiaryLabel').textContent = 'Purpose:';
                document.getElementById('beneficiaryName').placeholder = 'Enter purpose';
                document.getElementById('rrNoField').style.display = 'none';
            } else {
                // Hide notification options
                notificationGroup.style.display = 'none';

                document.getElementById('fromAccountLabel').textContent = 'From Account No:';
                document.getElementById('toAccountLabel').textContent = 'To Account No:';
                document.getElementById('beneficiaryLabel').textContent = 'Beneficiary Name:';
                document.getElementById('beneficiaryName').placeholder = 'Enter beneficiary name';
                document.getElementById('rrNoField').style.display = 'flex';
            }
        });
    });

    // Form submission handler
    document.getElementById('transferForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form data
        const formData = new FormData(this);
        const data = {
            transferType: formData.get('transferType'),
            notificationType: formData.get('notificationType') || '1',
            amount: formData.get('amount'),
            jrnlNo: formData.get('jrnlNo'),
            rrno: formData.get('rrno'),
            fromAccount: formData.get('fromAccount'),
            toAccount: formData.get('toAccount'),
            beneficiaryName: formData.get('beneficiaryName').toUpperCase()
        };

        // Populate receipt
        populateReceipt(data);

        // Show receipt, hide form
        document.getElementById('formSection').style.display = 'none';
        document.getElementById('receiptSection').style.display = 'block';
    });

    function formatIndianNumber(amount) {
        // Ensure it's a number and fixed to 2 decimal places
        const num = Number(amount).toFixed(2); // e.g., "1234567.00" or "1234.50"
        const parts = num.split('.');
        let intPart = parts[0];
        const decimalPart = '.' + parts[1]; // Always present due to toFixed(2)

        // Format integer part in Indian style
        let lastThree = intPart.slice(-3);
        let otherNumbers = intPart.slice(0, -3);

        if (otherNumbers !== '') {
            lastThree = ',' + lastThree;
            otherNumbers = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',');
        }

        return otherNumbers + lastThree + decimalPart;
    }

    function formatUSNumber(amount) {
        const num = Number(amount).toFixed(2); // ensures 2 decimal places
        const parts = num.split('.');
        const intPart = parts[0];
        const decimalPart = '.' + parts[1];

        // Format with commas every 3 digits from the right
        const formattedInt = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        return formattedInt + decimalPart;
    }


    function populateReceipt(data) {
        const {
            date,
            time
        } = getCurrentDateTime();

        const isSameBank = data.transferType === 'same';

        // Handle check icon display
        const completedIcon = document.querySelector('.check-icon.completed');
        const incompletedIcon = document.querySelector('.check-icon.incompleted');

        if (isSameBank && data.notificationType === '3') {
            completedIcon.style.display = 'none';
            incompletedIcon.style.display = 'block';
        } else {
            completedIcon.style.display = 'block';
            incompletedIcon.style.display = 'none';
        }

        // Update success title
        if (isSameBank) {
            document.getElementById('successTitle').innerHTML = 'Fund Transfer to BoB Successful';
        } else {
            document.getElementById('successTitle').innerHTML = 'Fund Transfer to Other Bank<br>Successful';
        }
        var transAmount = formatUSNumber(data.amount);

        // Update labels in receipt
        if (isSameBank) {
            document.getElementById('receiptFromAccountLabel').innerHTML =
                '<span>From Account</span><span class="colen-cls">:</span>';
            document.getElementById('receiptToAccountLabel').innerHTML =
                '<span>To Account</span><span class="colen-cls">:</span>';
            document.getElementById('receiptBeneficiaryLabel').innerHTML =
                '<span>Purpose</span><span class="colen-cls">:</span>';

            // Show selected notification
            document.querySelectorAll('.notification-card').forEach(card => {
                card.style.display = 'none';
            });
            document.querySelector(`[data-notify="${data.notificationType}"]`).style.display = 'block';

            // Update notification content
            const selectedNotification = document.querySelector(`[data-notify="${data.notificationType}"]`);
            selectedNotification.querySelectorAll('.trans-jrnl').forEach(el => {
                if (data.notificationType === '3') {
                    el.textContent = `${data.jrnlNo}...`;
                } else {
                    el.textContent = `${data.jrnlNo}`;
                }
            });
            selectedNotification.querySelectorAll('.trans-from-account').forEach(el => el.textContent =
                maskAccountNumber(data.fromAccount));
            selectedNotification.querySelectorAll('.trans-to-account').forEach(el => el.textContent = maskAccountNumber(
                data.toAccount));
            selectedNotification.querySelectorAll('.trans-purpose').forEach(el => el.textContent =
                `${data.beneficiaryName || ''}`);
            selectedNotification.querySelectorAll('.trans-date').forEach(el => el.textContent = `${date}`);
            selectedNotification.querySelectorAll('.trans-time').forEach(el => el.textContent = `${time}`);
            selectedNotification.querySelectorAll('.trans-amount').forEach(el => el.textContent = `Nu. ${transAmount}`);

        } else {
            document.getElementById('receiptFromAccountLabel').innerHTML =
                '<span>From Account No</span><span class="colen-cls">:</span>';
            document.getElementById('receiptToAccountLabel').innerHTML =
                '<span>To Account No</span><span class="colen-cls">:</span>';
            document.getElementById('receiptBeneficiaryLabel').innerHTML =
                '<span>Beneficiary Name</span><span class="colen-cls">:</span>';

        }


        // Populate all fields
        document.getElementById('receiptAmount').textContent = ` Nu. ${transAmount}`;
        document.getElementById('receiptJrnl').textContent = ` ${data.jrnlNo}`;
        document.getElementById('receiptRrno').textContent = ` ${data.rrno}`;
        document.getElementById('receiptFromAccount').textContent = ` ${maskAccountNumber(data.fromAccount)}`;
        document.getElementById('receiptToAccount').textContent = ` ${maskAccountNumber(data.toAccount)}`;
        document.getElementById('receiptBeneficiary').textContent = ` ${data.beneficiaryName}`;
        document.getElementById('receiptDate').textContent = ` ${date}`;
        document.getElementById('receiptTime').textContent = ` ${time}`;
    }

    document.querySelector('.expand-button').addEventListener('click', function() {
        const notif = document.querySelector('.notification-card[style*="block"]');
        if (notif) {
            notif.style.display = (notif.style.display === 'none' || notif.style.display === '') ? 'block' :
                'none';
        }
    });


    function goBackToForm() {
        // Clear form
        document.getElementById('transferForm').reset();
        // Reset to default (Other Bank)
        document.getElementById('otherBank').checked = true;
        // Hide notification options
        document.getElementById('notificationGroup').style.display = 'none';
        // Reset labels to default
        document.getElementById('fromAccountLabel').textContent = 'From Account No:';
        document.getElementById('toAccountLabel').textContent = 'To Account No:';
        document.getElementById('beneficiaryLabel').textContent = 'Beneficiary Name:';
        document.getElementById('beneficiaryName').placeholder = 'Enter beneficiary name';

        // Hide all notifications
        document.querySelectorAll('.notification-card').forEach(card => {
            card.style.display = 'none';
        });

        // Show form, hide receipt
        document.getElementById('receiptSection').style.display = 'none';
        document.getElementById('formSection').style.display = 'block';
    }
    </script>
</body>

</html>