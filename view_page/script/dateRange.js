            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Date range picker
            $('#reservation').daterangepicker({
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "ตกลง",
                    "cancelLabel": "ยกเลิก",
                    "fromLabel": "จาก",
                    "toLabel": "ถึง",
                    "customRangeLabel": "กำหนดเอง",
                    "daysOfWeek": [
                        "อา",
                        "จ.",
                        "อ.",
                        "พ.",
                        "พฤ.",
                        "ศ.",
                        "ส."
                    ],
                    "monthNames": [
                        "มกราคม",
                        "กุมพาพันธ์",
                        "มีนาคม",
                        "เมษายน",
                        "พฤษภาคม",
                        "มิถุนายน",
                        "กรกฎาคม",
                        "สิงหาคม",
                        "กันยายน",
                        "ตุลาคม",
                        "พฤศจิกายน",
                        "ธันวาคม"
                    ],
                    "firstDay": 1
                }
            });