import { Api } from './Api.js'

export default {

    setContext(context) {
        // Put the object into storage
        localStorage.setItem('context', JSON.stringify(context));
    },

    updateContext(access_token) {
        //Get the context from localStorage
        let context = JSON.parse(localStorage.getItem('context'))
        context.access_token = access_token
        localStorage.setItem('context', JSON.stringify(context))
    },

    renewToken(access_token, email) {
        //let service = 'http://127.0.0.1:8080/Vue/WhiteRabbitComputers/oauth2/token/create.php'
        return Api.put('token/create.php', {
            access_token: access_token,
            lang: 'en',
            dev: 1,
            client_id: email
        })

    },

    validateToken(access_token, email) {

        return Api.get('token/validate.php?access_token=' + access_token + '&lang=en&dev=1')

    },

    getContext() {
        // Retrieve the object from storage
        let context = JSON.parse(localStorage.getItem('context'))

        if (context !== null) {
            if (typeof(context.email) !== 'undefined' && typeof(context.access_token) !== 'undefined' && context.access_token !== null) {
                //validate the token
                this.validateToken(context.access_token, context.email)
                    .then(newToken => {
                        if (typeof(newToken.data.message) !== 'undefined' && typeof(newToken.data.success) !== 'undefined') {
                            if (newToken.data.message === 'Token is valid' && newToken.data.success === 0) {
                                //Token is valid
                            } else {
                                if (newToken.data.message === 'Token has expired') {
                                    //renew token
                                    this.renewToken(context.access_token, context.email)
                                        .then(renewToken => {
                                            if (typeof(renewToken.data.access_token) !== 'undefined') {
                                                context.access_token = renewToken.data.access_token
                                                this.updateContext(renewToken.data.access_token)
                                            }
                                        })
                                } else {
                                    //error
                                    if (newToken.data.message === 'Invalid token') {
                                        this.destroyContext()
                                    }
                                }
                            }
                        }
                    }).catch(error => {
                        if (error.response) {
                            alert(error.response);
                        }
                    })
            } else {
                context = { access_token: null, name: null, authenticate: false, admin: null, email: null, uid: null, creationdate: null }
            }
        } else {
            context = { access_token: null, name: null, authenticate: false, admin: null, email: null, uid: null, creationdate: null }
        }



        return context
    },

    destroyContext() {
        let context = { access_token: null, name: null, authenticate: false, admin: null, email: null, uid: null, creationdate: null }
        localStorage.setItem('context', JSON.stringify(context));

        return context
    },
    /*
        async getContext() {

            const result = { updated: false, data: {} }
            const res = await Api.get('getContext.php')
            result.data = res.data

            //result.data.access_token = '89355040a2f383a1074c3285b06c868feb5753e6'

            if (typeof(result.data.email) !== 'undefined' && typeof(result.data.access_token) !== 'undefined' && result.data.access_token !== null) {
                //validate the token
                const newToken = await this.validateToken(result.data.access_token, result.data.email)

                if (typeof(newToken.data.message) !== 'undefined' && typeof(newToken.data.success) !== 'undefined') {
                    if (newToken.data.message === 'Token is valid' && newToken.data.success === 0) {
                        console.log('Token is valid')
                        result.updated = true
                    } else {
                        if (newToken.data.message === 'Token has expired') {
                            //renew token
                            const renewToken = await this.renewToken(result.data.access_token, result.data.email)
                            if (typeof(renewToken.data.access_token) !== 'undefined') {
                                result.data.access_token = renewToken.data.access_token
                                await this.updateContext(result.data.access_token)
                                result.updated = true
                            }
                        } else {
                            //error
                            if (newToken.data.message === 'Invalid token') {
                                await this.destroyContext()
                            }
                            console.log(newToken.data.message)
                            result.updated = true
                        }
                    }
                } else {
                    //error
                    console.log('Token error')
                    result.updated = true
                }
            } else {
                result.updated = true
            }

            return result
        },

        async destroyContext() {
            await Api.get('destroyContext.php')

            const res = await this.getContext()

            return res
        },
    */
    /**
     * Secure Hash Algorithm (SHA1)
     * http://www.webtoolkit.info/
     **/
    SHA1(msg) {
        function rotate_left(n, s) {
            var t4 = (n << s) | (n >>> (32 - s));
            return t4;
        }
        /*
                function lsb_hex(val) {
                    var str = '';
                    var i;
                    var vh;
                    var vl;
                    for (i = 0; i <= 6; i += 2) {
                        vh = (val >>> (i * 4 + 4)) & 0x0f;
                        vl = (val >>> (i * 4)) & 0x0f;
                        str += vh.toString(16) + vl.toString(16);
                    }
                    return str;
                }
        */
        function cvt_hex(val) {
            var str = '';
            var i;
            var v;
            for (i = 7; i >= 0; i--) {
                v = (val >>> (i * 4)) & 0x0f;
                str += v.toString(16);
            }
            return str;
        }

        function Utf8Encode(string) {
            string = string.replace(/\r\n/g, '\n');
            var utftext = '';
            for (var n = 0; n < string.length; n++) {
                var c = string.charCodeAt(n);
                if (c < 128) {
                    utftext += String.fromCharCode(c);
                } else if ((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                } else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
            }
            return utftext;
        }
        var blockstart;
        var i, j;
        var W = new Array(80);
        var H0 = 0x67452301;
        var H1 = 0xEFCDAB89;
        var H2 = 0x98BADCFE;
        var H3 = 0x10325476;
        var H4 = 0xC3D2E1F0;
        var A, B, C, D, E;
        var temp;
        msg = Utf8Encode(msg);
        var msg_len = msg.length;
        var word_array = new Array();
        for (i = 0; i < msg_len - 3; i += 4) {
            j = msg.charCodeAt(i) << 24 | msg.charCodeAt(i + 1) << 16 |
                msg.charCodeAt(i + 2) << 8 | msg.charCodeAt(i + 3);
            word_array.push(j);
        }
        switch (msg_len % 4) {
            case 0:
                i = 0x080000000;
                break;
            case 1:
                i = msg.charCodeAt(msg_len - 1) << 24 | 0x0800000;
                break;
            case 2:
                i = msg.charCodeAt(msg_len - 2) << 24 | msg.charCodeAt(msg_len - 1) << 16 | 0x08000;
                break;
            case 3:
                i = msg.charCodeAt(msg_len - 3) << 24 | msg.charCodeAt(msg_len - 2) << 16 | msg.charCodeAt(msg_len - 1) << 8 | 0x80;
                break;
        }
        word_array.push(i);
        while ((word_array.length % 16) != 14) word_array.push(0);
        word_array.push(msg_len >>> 29);
        word_array.push((msg_len << 3) & 0x0ffffffff);
        for (blockstart = 0; blockstart < word_array.length; blockstart += 16) {
            for (i = 0; i < 16; i++) W[i] = word_array[blockstart + i];
            for (i = 16; i <= 79; i++) W[i] = rotate_left(W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16], 1);
            A = H0;
            B = H1;
            C = H2;
            D = H3;
            E = H4;
            for (i = 0; i <= 19; i++) {
                temp = (rotate_left(A, 5) + ((B & C) | (~B & D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B, 30);
                B = A;
                A = temp;
            }
            for (i = 20; i <= 39; i++) {
                temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B, 30);
                B = A;
                A = temp;
            }
            for (i = 40; i <= 59; i++) {
                temp = (rotate_left(A, 5) + ((B & C) | (B & D) | (C & D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B, 30);
                B = A;
                A = temp;
            }
            for (i = 60; i <= 79; i++) {
                temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B, 30);
                B = A;
                A = temp;
            }
            H0 = (H0 + A) & 0x0ffffffff;
            H1 = (H1 + B) & 0x0ffffffff;
            H2 = (H2 + C) & 0x0ffffffff;
            H3 = (H3 + D) & 0x0ffffffff;
            H4 = (H4 + E) & 0x0ffffffff;
        }
        temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);

        return temp.toLowerCase();
    }
}