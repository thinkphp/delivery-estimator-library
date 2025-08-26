# PHP Delivery Interval Generator

A simple PHP function to generate estimated delivery date ranges for e-commerce applications, with support for business days calculation.

## Function Overview

```php
generateDeliveryInterval($minDays = 1, $maxDays = 14, $skipWeekends = true)
```

Generates a formatted delivery estimate string starting from tomorrow and ending after a specified number of days.

## Parameters

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$minDays` | int | 1 | Minimum delivery days (currently fixed to start from tomorrow) |
| `$maxDays` | int | 14 | Maximum delivery days from today |
| `$skipWeekends` | bool | true | Whether to count only business days (Mon-Fri) |

## Usage Examples

### Basic Usage
```php
// Default: 14 business days delivery window
echo generateDeliveryInterval();
// Output: "Est. delivery Tue, 27 - Thu, Sep 12"
```

### Custom Delivery Windows
```php
// Express delivery (5 business days)
echo generateDeliveryInterval(1, 5, true);
// Output: "Est. delivery Tue, 27 - Mon, Sep 2"

// Standard delivery (10 business days)
echo generateDeliveryInterval(1, 10, true);
// Output: "Est. delivery Tue, 27 - Fri, Sep 6"

// Economy delivery (21 calendar days, including weekends)
echo generateDeliveryInterval(1, 21, false);
// Output: "Est. delivery Tue, 27 - Tue, Sep 16"
```

### Integration in HTML
```html
<div class="delivery-info">
    <i class="fas fa-clock"></i> <?= generateDeliveryInterval() ?>
</div>
```

## Output Format

The function returns a string in the format:
- **Start date**: `Day, Number` (e.g., "Tue, 27")
- **End date**: `Day, Month Number` (e.g., "Thu, Sep 12")
- **Full format**: `"Est. delivery [start] - [end]"`

## How It Works

1. **Start Date**: Always begins from tomorrow (`today + 1 day`)
2. **End Date Calculation**:
   - If `$skipWeekends = true`: Counts only Monday-Friday as valid delivery days
   - If `$skipWeekends = false`: Counts all calendar days including weekends
3. **Date Formatting**: Uses abbreviated day names and month names for compact display

## Business Days Logic

When `$skipWeekends = true`, the function:
- Skips Saturdays (day 6) and Sundays (day 7)
- Only counts Monday (1) through Friday (5) as working days
- Uses PHP's `DateTime::format('N')` where Monday = 1, Sunday = 7

## Real-World Examples

Assuming today is **Monday, August 26, 2025**:

| Configuration | Output | Description |
|---------------|--------|-------------|
| `generateDeliveryInterval()` | `Est. delivery Tue, 27 - Thu, Sep 12` | 14 business days |
| `generateDeliveryInterval(1, 7, true)` | `Est. delivery Tue, 27 - Wed, Sep 3` | 1 week business days |
| `generateDeliveryInterval(1, 3, false)` | `Est. delivery Tue, 27 - Thu, 29` | 3 calendar days |
| `generateDeliveryInterval(1, 30, true)` | `Est. delivery Tue, 27 - Mon, Oct 6` | 30 business days |

## Dependencies

- **PHP 5.2+**: Requires `DateTime` class
- **No external libraries**: Uses only native PHP functions

## Installation

1. Copy the function into your PHP file
2. Call the function where you need delivery estimates
3. Optionally customize default parameters for your business needs

## Customization

### Modify Default Values
```php
// Change defaults for your business
function generateDeliveryInterval($minDays = 2, $maxDays = 10, $skipWeekends = false) {
    // ... function code
}
```

### Different Date Formats
Modify the format strings in the function:
```php
// Current format
$minFormatted = $minDate->format('D, j'); // "Tue, 27"
$maxFormatted = $maxDate->format('D, M j'); // "Thu, Sep 12"

// Alternative formats
$minFormatted = $minDate->format('l, F j'); // "Tuesday, August 27"
$maxFormatted = $maxDate->format('M j, Y'); // "Sep 12, 2025"
```

## Use Cases

- **E-commerce product pages**: Show delivery estimates on item detail pages
- **Shopping carts**: Display expected delivery for cart items  
- **Order confirmation**: Provide delivery windows after purchase
- **Shipping calculators**: Dynamic delivery estimation tools
- **Multi-tier shipping**: Different delivery speeds (express, standard, economy)

## Notes

- Function assumes current server timezone
- Always starts delivery from tomorrow (not same day)
- Weekend calculation uses ISO-8601 standard (Monday = 1, Sunday = 7)
- Output is localized to English abbreviated day/month names

## License

Free to use and modify for any purpose.
