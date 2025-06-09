#!/usr/bin/env python3
import json
import os

def clean_json(input_file, output_file=None):
    """
    Clean JSON data by removing specified fields.
    
    Args:
        input_file (str): Path to the input JSON file
        output_file (str, optional): Path to the output JSON file. If None, will use input_file with '_cleaned' suffix
    
    Returns:
        str: Path to the output file
    """
    # Define fields to remove
    fields_to_remove = [
        'state', 'fax', 'id', 'description', 'country', 'website', 
        'description_2', 'logo_id', 'marker_id', 'is_disabled',
        'brand', 'special', 'custom', 'ordr', 'slug', 'lang', 
        'pending', 'created_on', 'updated_on'
    ]
    
    # Set default output file if not provided
    if output_file is None:
        base, ext = os.path.splitext(input_file)
        output_file = f"{base}_cleaned{ext}"
    
    # Read the JSON data
    with open(input_file, 'r', encoding='utf-8') as f:
        data = json.load(f)
    
    # Clean the data
    cleaned_data = []
    for item in data:
        cleaned_item = {k: v for k, v in item.items() if k not in fields_to_remove}

        # Process 'open_hours' field
        if 'open_hours' in cleaned_item and isinstance(cleaned_item['open_hours'], str):
            try:
                open_hours_data = json.loads(cleaned_item['open_hours'])
                if isinstance(open_hours_data, dict):
                    for day, hours in open_hours_data.items():
                        if isinstance(hours, list) and len(hours) > 0:
                            open_hours_data[day] = hours[0]
                    cleaned_item['open_hours'] = json.dumps(open_hours_data) # Ensure it's stored as a string again
            except json.JSONDecodeError:
                # If 'open_hours' is not a valid JSON string, leave it as is or log an error
                pass # Or print(f"Warning: Could not parse open_hours for an item: {cleaned_item.get('name', 'N/A')}")

        cleaned_data.append(cleaned_item)
    
    # Write the cleaned data to the output file
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(cleaned_data, f, indent=2, ensure_ascii=False)
    
    print(f"Original data had {len(data)} items with {len(data[0].keys())} fields per item")
    print(f"Cleaned data has {len(cleaned_data)} items with {len(cleaned_data[0].keys())} fields per item")
    print(f"Removed fields: {', '.join(fields_to_remove)}")
    print(f"Cleaned data written to {output_file}")
    
    return output_file

if __name__ == "__main__":
    input_file = "/home/snsa/Desktop/vite/preprocessing/data.json"
    clean_json(input_file)
