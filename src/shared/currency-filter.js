export default function(value, symbol) {
    if (!value) return '';
    return `${value.toFixed(2)} ${symbol}`;
}