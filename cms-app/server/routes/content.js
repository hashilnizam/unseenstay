const express = require('express');
const fs = require('fs').promises;
const path = require('path');
const authMiddleware = require('../middleware/auth');
const router = express.Router();

const DATA_JSON_PATH = path.join(__dirname, process.env.DATA_JSON_PATH || '../../../assets/core/data.json');
const DESTINATIONS_PATH = path.join(__dirname, '../../../assets/data/destinations');

// Helper function to read JSON file with error handling
async function readJsonFile(filePath) {
  try {
    const data = await fs.readFile(filePath, 'utf8');
    return JSON.parse(data);
  } catch (error) {
    console.error(`Error reading file ${filePath}:`, error);
    return null;
  }
}

// Get all destinations with their properties
router.get('/destinations', authMiddleware, async (req, res) => {
  try {
    const files = await fs.readdir(DESTINATIONS_PATH);
    const destinations = [];

    for (const file of files) {
      if (file.endsWith('.json')) {
        const filePath = path.join(DESTINATIONS_PATH, file);
        const data = await readJsonFile(filePath);
        if (data) {
          destinations.push({
            id: file.replace('.json', ''),
            name: data.name || 'Unnamed Destination',
            properties: data.properties || [],
            image: data.coverImage || null
          });
        }
      }
    }

    res.json(destinations);
  } catch (error) {
    console.error('Error fetching destinations:', error);
    res.status(500).json({ 
      error: 'Failed to fetch destinations', 
      message: error.message 
    });
  }
});

// Get all content
router.get('/', authMiddleware, async (req, res) => {
  try {
    const data = await fs.readFile(DATA_JSON_PATH, 'utf8');
    res.json(JSON.parse(data));
  } catch (error) {
    res.status(500).json({ error: 'Failed to read data', message: error.message });
  }
});

// Get specific section
router.get('/:section', authMiddleware, async (req, res) => {
  try {
    const data = await fs.readFile(DATA_JSON_PATH, 'utf8');
    const jsonData = JSON.parse(data);
    const section = jsonData[req.params.section];
    
    if (!section) {
      return res.status(404).json({ error: 'Section not found' });
    }
    
    res.json(section);
  } catch (error) {
    res.status(500).json({ error: 'Failed to read section', message: error.message });
  }
});

// Update entire content
router.put('/', authMiddleware, async (req, res) => {
  try {
    const newData = req.body;
    await fs.writeFile(DATA_JSON_PATH, JSON.stringify(newData, null, 2), 'utf8');
    res.json({ success: true, message: 'Content updated successfully' });
  } catch (error) {
    res.status(500).json({ error: 'Failed to update content', message: error.message });
  }
});

// Update specific section
router.put('/:section', authMiddleware, async (req, res) => {
  try {
    const data = await fs.readFile(DATA_JSON_PATH, 'utf8');
    const jsonData = JSON.parse(data);
    
    jsonData[req.params.section] = req.body;
    
    await fs.writeFile(DATA_JSON_PATH, JSON.stringify(jsonData, null, 2), 'utf8');
    res.json({ success: true, message: 'Section updated successfully' });
  } catch (error) {
    res.status(500).json({ error: 'Failed to update section', message: error.message });
  }
});

// Update nested field (supports dot notation)
router.patch('/field', authMiddleware, async (req, res) => {
  try {
    const { path: fieldPath, value } = req.body;
    
    const data = await fs.readFile(DATA_JSON_PATH, 'utf8');
    const jsonData = JSON.parse(data);
    
    // Set nested value using path
    const keys = fieldPath.split('.');
    let current = jsonData;
    
    for (let i = 0; i < keys.length - 1; i++) {
      if (!current[keys[i]]) {
        current[keys[i]] = {};
      }
      current = current[keys[i]];
    }
    
    current[keys[keys.length - 1]] = value;
    
    await fs.writeFile(DATA_JSON_PATH, JSON.stringify(jsonData, null, 2), 'utf8');
    res.json({ success: true, message: 'Field updated successfully', data: jsonData });
  } catch (error) {
    res.status(500).json({ error: 'Failed to update field', message: error.message });
  }
});

// Add item to array
router.post('/array/add', authMiddleware, async (req, res) => {
  try {
    const { path: arrayPath, item } = req.body;
    
    const data = await fs.readFile(DATA_JSON_PATH, 'utf8');
    const jsonData = JSON.parse(data);
    
    // Navigate to array
    const keys = arrayPath.split('.');
    let current = jsonData;
    
    for (let key of keys) {
      if (!current[key]) {
        current[key] = [];
      }
      current = current[key];
    }
    
    if (!Array.isArray(current)) {
      return res.status(400).json({ error: 'Path does not point to an array' });
    }
    
    current.push(item);
    
    await fs.writeFile(DATA_JSON_PATH, JSON.stringify(jsonData, null, 2), 'utf8');
    res.json({ success: true, message: 'Item added successfully', data: jsonData });
  } catch (error) {
    res.status(500).json({ error: 'Failed to add item', message: error.message });
  }
});

// Remove item from array
router.post('/array/remove', authMiddleware, async (req, res) => {
  try {
    const { path: arrayPath, index } = req.body;
    
    const data = await fs.readFile(DATA_JSON_PATH, 'utf8');
    const jsonData = JSON.parse(data);
    
    // Navigate to array
    const keys = arrayPath.split('.');
    let current = jsonData;
    
    for (let key of keys) {
      current = current[key];
    }
    
    if (!Array.isArray(current)) {
      return res.status(400).json({ error: 'Path does not point to an array' });
    }
    
    current.splice(index, 1);
    
    await fs.writeFile(DATA_JSON_PATH, JSON.stringify(jsonData, null, 2), 'utf8');
    res.json({ success: true, message: 'Item removed successfully', data: jsonData });
  } catch (error) {
    res.status(500).json({ error: 'Failed to remove item', message: error.message });
  }
});

// Update item in array
router.post('/array/update', authMiddleware, async (req, res) => {
  try {
    const { path: arrayPath, index, item } = req.body;
    
    const data = await fs.readFile(DATA_JSON_PATH, 'utf8');
    const jsonData = JSON.parse(data);
    
    // Navigate to array
    const keys = arrayPath.split('.');
    let current = jsonData;
    
    for (let key of keys) {
      current = current[key];
    }
    
    if (!Array.isArray(current)) {
      return res.status(400).json({ error: 'Path does not point to an array' });
    }
    
    current[index] = item;
    
    await fs.writeFile(DATA_JSON_PATH, JSON.stringify(jsonData, null, 2), 'utf8');
    res.json({ success: true, message: 'Item updated successfully', data: jsonData });
  } catch (error) {
    res.status(500).json({ error: 'Failed to update item', message: error.message });
  }
});

module.exports = router;
