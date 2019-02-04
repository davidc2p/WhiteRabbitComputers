import Api from './Api.js'

export default {

    checkServiceAuth(message) {
        if (typeof(message) !== 'undefined' && (message == 'Invalid token' || message == 'Token has expired')) {
            return false
        } else {
            return true
        }
    }
}