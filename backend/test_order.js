const http = require('http');

const data = JSON.stringify({
    customer_name: 'John Doe',
    customer_email: 'john@example.com',
    customer_phone: '0771234567',
    delivery_address: '123 Galle Road, Colombo',
    total_amount: 5500.00,
    items: [
        {
            product_name: 'Premium Exterior Emulsion',
            pack_size: '4L',
            quantity: 1,
            unit_price: 3000.00,
            total_price: 3000.00
        }
    ]
});

const options = {
    hostname: '127.0.0.1',
    port: 8002,
    path: '/api/orders',
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Content-Length': Buffer.byteLength(data)
    }
};

const req = http.request(options, res => {
    let body = '';
    res.on('data', chunk => body += chunk);
    res.on('end', () => console.log(res.statusCode, body));
});

req.on('error', e => console.error(e));
req.write(data);
req.end();
