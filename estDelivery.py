from datetime import datetime, timedelta

def generate_delivery_interval(min_days=1, max_days=14, skip_weekends=True):
    start = datetime.now()
    
    # Calculate minimum delivery date (starting tomorrow)
    min_date = start + timedelta(days=min_days)
    
    # Calculate maximum delivery date
    max_date = start
    if skip_weekends:
        days_added = 0
        while days_added < max_days:
            max_date += timedelta(days=1)
            if max_date.isoweekday() < 6:  # Monday=1, Sunday=7
                days_added += 1
    else:
        max_date += timedelta(days=max_days)
    
    # Format dates - show day and date
    min_formatted = min_date.strftime('%a, %-d')  # Thu, 27
    max_formatted = max_date.strftime('%a, %b %-d')  # Thu, Sep 9
    
    return f"Est. delivery {min_formatted} - {max_formatted}"

# Test the function
print(generate_delivery_interval())
