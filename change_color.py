import os

directories = [
    r"d:\CODE\WEB_SMK\resources\views\public",
    r"d:\CODE\WEB_SMK\resources\views\layouts"
]

for directory in directories:
    for filename in os.listdir(directory):
        if filename.endswith(".blade.php"):
            filepath = os.path.join(directory, filename)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # Replace colors
            content = content.replace('blue-', 'primary-')
            content = content.replace('indigo-', 'primary-')
            content = content.replace('purple-', 'primary-')
            content = content.replace('sky-', 'primary-')
            
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)

print("Colors updated successfully in Blade files.")
