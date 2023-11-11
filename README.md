# Technology Security Web Page - Software Table Generator

## Overview

The provided PHP script is designed to generate a dynamic table showcasing permitted and disallowed IT tools and products for specific data types. This script is part of a broader web page developed for the Office of Information Technology (OIT) and its Technology Security division.

## Features

### 1. Dynamic Tables

The script utilizes dynamic tables to display a detailed list of IT tools and products, allowing for easy editing and management of software and data policies.

### 2. Integration with Advanced Custom Fields (ACF) Plugin

Integration with the Advanced Custom Fields (ACF) plugin streamlines the process of updating software information. Software updates only require changes to the ACF list, eliminating the need for additional PHP code edits.

### 3. User-Friendly Interface

The generated table includes colored indicators controlled by checkboxes, providing a user-friendly platform for managing software and data policies without the need for coding.

### 4. Stipulation Messages

Stipulation messages are displayed for certain software entries, indicating conditions such as written approval requirements from the Office of Research and Engagement (ORIED) or Institutional Review Board (IRB). These messages provide additional context and guidelines for software usage.

### 5. Accessibility

The script prioritizes accessibility by incorporating proper screen reader codes for color indicators, ensuring compliance with the Americans with Disabilities Act (ADA) standards.

## Usage

To use this script effectively, follow these steps:

1. **Dynamic Tables:** Edit software and data policies easily by making changes to the dynamic tables on the respective pages.

2. **ACF Integration:** To update software information, modify the ACF list without the need for additional PHP code changes.

3. **Customization:** Utilize the checkboxes and colored indicators on software edit pages for easy customization and stipulations.

4. **Accessibility:** Ensure ADA compliance by following the proper screen reader codes associated with color indicators.

## Notes

- The script assumes WordPress is being used, as it includes WordPress functions like `get_header`, `get_sidebar`, and `get_footer`.
