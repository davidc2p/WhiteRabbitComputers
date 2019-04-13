export default class ClassResource {

    letterAvatar(name, size) {

        name = name || '';
        size = size || 60;

        var colours = [
                "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
                "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
            ],

            nameSplit = String(name).toUpperCase().split(' '),
            initials, charIndex, colourIndex, canvas, context, dataURI;


        if (nameSplit.length == 1) {
            initials = nameSplit[0] ? nameSplit[0].charAt(0) : '?';
        } else {
            initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
        }

        // if (w.devicePixelRatio) {
        //     size = (size * w.devicePixelRatio);
        // }

        charIndex = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
        colourIndex = charIndex % 20;
        var canvas = document.createElement('canvas');
        canvas.width = size;
        canvas.height = size;
        context = canvas.getContext("2d");

        context.fillStyle = colours[colourIndex - 1];
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.font = Math.round(canvas.width / 2) + "px Arial";
        context.textAlign = "center";
        context.fillStyle = "#FFF";
        context.fillText(initials, size / 2, size / 1.5);

        dataURI = canvas.toDataURL();
        canvas = null;

        return dataURI;
    }


    scrollToElement(pageElement) {
        var positionX = 0,
            positionY = 0;

        while (pageElement != null) {
            positionX += pageElement.offsetLeft;
            positionY += pageElement.offsetTop;
            pageElement = pageElement.offsetParent;
            window.scrollTo(positionX, positionY - 70);
        }
    }

    dateToYYYYMMDDD(date) {
        var d = date.getDate();
        var m = date.getMonth() + 1; //Month from 0 to 11
        var y = date.getFullYear();
        return '' + y + '-' + (m <= 9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
    }

    dateToDDMM(date) {
        var d = date.getDate();
        var m = date.getMonth() + 1; //Month from 0 to 11
        return '' + (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m);
    }

    secondstoHHHMM(seconds) {
        var h = Math.floor(seconds / 3600);
        var divisor_for_minutes = seconds % (60 * 60);
        var m = Math.floor(divisor_for_minutes / 60);
        return (h <= 9 ? '0' + h : h) + ':' + (m <= 9 ? '0' + m : m);
    }

    addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

    diffDays(date1, date2) {
        let d1 = new Date(date1)
        let d2 = new Date(date2)
        let timeDiff = d2.getTime() - d1.getTime()
        let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))

        return diffDays;
    }

    keySort(arr, keys) {

        keys = keys || {}

        // via
        // j
        var obLen = function(obj) {
            var size = 0,
                key;
            for (key in obj) {
                if (obj.hasOwnProperty(key))
                    size++
            }
            return size;
        }

        // avoiding using Object.keys because I guess did it have IE8 issues?
        // else var obIx = function(obj, ix){ return Object.keys(obj)[ix]; } or
        // whatever
        var obIx = function(obj, ix) {
            var size = 0,
                key
            for (key in obj) {
                if (obj.hasOwnProperty(key)) {
                    if (size == ix)
                        return key
                    size++
                }
            }
            return false
        }

        var keySort = function(a, b, d) {
            d = d !== null ? d : 1
                // a = a.toLowerCase(); // this breaks numbers
                // b = b.toLowerCase();
            if (a == b)
                return 0
            return a > b ? 1 * d : -1 * d
        }

        var KL = obLen(keys)

        if (!KL)
            return arr.sort(keySort)

        for (var k in keys) {
            // asc unless desc or skip
            keys[k] =
                keys[k] == 'desc' || keys[k] == -1 ? -1 :
                (keys[k] == 'skip' || keys[k] === 0 ? 0 :
                    1);
        }

        arr.sort(function(a, b) {
            var sorted = 0,
                ix = 0;

            while (sorted === 0 && ix < KL) {
                var k = obIx(keys, ix)
                if (k) {
                    var dir = keys[k];
                    sorted = keySort(a[k], b[k], dir)
                    ix++
                }
            }
            return sorted
        })
        return arr
    }

    pad(n, width, z) {
        z = z || '0'
        n = n + ''
        let out = n.length >= width ? n : new Array(width - n.length + 1).join(z) + n
        return out
    }

    calculateNetPricex(total) {
        let netPrice = 0

        if (total > 0) {
            netPrice = Math.floor(Number(total / 100)) * 100
            switch (true) {
                case (total < 500):
                    netPrice += (total - netPrice < 50) ? 149.9 : 199.9
                    break

                case (total >= 500 && total < 1000):
                    netPrice += (total - netPrice < 50) ? 199.9 : 249.9
                    break

                case (total >= 1000):
                    netPrice += (total - netPrice < 50) ? 249.9 : 299.9
                    break

            }
        }
        return netPrice
    }

    calculateNetPrice(total) {
        let netPrice = total

        if (total > 0) {
            switch (true) {
                case (total < 500):
                    netPrice += 100
                    break

                case (total >= 500 && total < 1000):
                    netPrice += 120
                    break

                case (total >= 1000):
                    netPrice += 150
                    break

            }
            netPrice = Math.floor(Number(netPrice / 10)) * 10 + 9.9
        }
        return netPrice
    }

}